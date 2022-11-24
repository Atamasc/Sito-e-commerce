<?php

class ControlloMail
{
    public
        $nc_contatore_totale = 0,
        $nc_contatore_giorno = 0,
        $nc_limite,
        $nc_limite_giorno,
        $nc_ultimo_invio,
        $nc_stato,
        $nc_data_al,
        $nc_data_dal,
        $nc_sender,
        $conn;

    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
        $querySql_nc = "SELECT * FROM nc_newsletter_contatore WHERE nc_id = 1 ";
        $result_nc = $this->conn->query($querySql_nc);
        $rows_nc = $this->conn->affected_rows;
        if($rows_nc > 0)
        {
            $row_data_nc = $result_nc->fetch_assoc();
            $this->nc_contatore_totale = $row_data_nc["nc_contatore"];
            $this->nc_limite = $row_data_nc["nc_limite"];
            $this->nc_contatore_giorno = $row_data_nc["nc_contatore_giorno"];
            $this->nc_limite_giorno = $row_data_nc["nc_limite_giorno"];
            $this->nc_ultimo_invio = $row_data_nc["nc_ultimo_invio"];
            $this->nc_stato = $row_data_nc["nc_stato"];
            $this->nc_data_al = $row_data_nc["nc_data_al"];
            $this->nc_data_dal = $row_data_nc["nc_data_dal"];
            $this->nc_sender = $row_data_nc["nc_sender"];
            $result_nc->close();
            $this->CheckMail();
            $this->AggiornaTabella();
            return 1;
        }
        else
        {
            $result_nc->close();
            return 0;
        }
    }

    public function CheckMail()
    {
        $giorno = date("j", $this->nc_ultimo_invio);
        $giorno_corrente = date("j");
        if($giorno != $giorno_corrente) {
            $this->nc_contatore_giorno = 0;
            $this->AggiornaTabella();
        }

        $mese = date("n", $this->nc_ultimo_invio);
        $mese_corrente = date("n");
        if($mese != $mese_corrente) {
            $this->nc_contatore_totale = 0;
            $this->AggiornaTabella();
        }

        if($this->nc_stato == 0) return 0;
        if($this->nc_data_al < time())
        {
            $this->nc_stato = 0;
            $this->AggiornaTabella();
            return 0;
        }

        //if($this->nc_contatore_giorno > $this->nc_limite_giorno) return 0;

        if($this->nc_contatore_totale > $this->nc_limite) return 0;

        return 1;
    }

    public function CheckMailEx($email)
    {
        $giorno = date("j", $this->nc_ultimo_invio);
        $giorno_corrente = date("j");
        if($giorno != $giorno_corrente) {
            $this->nc_contatore_giorno = 0;
            $this->AggiornaTabella();
        }

        $mese = date("n", $this->nc_ultimo_invio);
        $mese_corrente = date("n");
        if($mese != $mese_corrente) {
            $this->nc_contatore_totale = 0;
            $this->AggiornaTabella();
        }

        if($this->nc_stato == 0) return 0;
        if($this->nc_data_al < time())
        {
            $this->nc_stato = 0;
            $this->AggiornaTabella();
            return 0;
        }

        /*$totale = $this->nc_contatore_giorno + $email;
        if($totale > $this->nc_limite_giorno) return 0;*/

        $totale = $this->nc_contatore_totale + $email;
        if($totale > $this->nc_limite) return 0;

        return 1;
    }

    public function InvioMail()
    {
        if(!$this->CheckMail()) return 0;
        $this->nc_contatore_totale++;
        $this->nc_contatore_giorno++;
        $this->nc_ultimo_invio = time();
        return 1;
    }

    public function AggiornaTabella()
    {
        $querySql_nc = "UPDATE nc_newsletter_contatore SET nc_contatore = " . $this->nc_contatore_totale . ", nc_contatore_giorno = " . $this->nc_contatore_giorno . ", nc_ultimo_invio = " . $this->nc_ultimo_invio . ", ";
        $querySql_nc .= " nc_stato = " . $this->nc_stato . " WHERE nc_id = 1 ";
        $result_nc = $this->conn->query($querySql_nc);
        $rows_nc = $this->conn->affected_rows;
        if($rows_nc > 0) return 1;
        else return 0;
    }

    public function EmailRimanentiMese()
    {
        $email = $this->nc_limite - $this->nc_contatore_totale;
        if($email < 0) $email = 0;
        return $email;
    }

    public function EmailRimanentiOggi()
    {
        $email = $this->nc_limite_giorno - $this->nc_contatore_giorno;
        if($email < 0) $email = 0;
        return $email;
    }

    public function GetEmailInfo()
    {
        if($this->nc_stato) $stato = "<span style='color: green'>Attivo</span>"; else $stato = "<span style='color: red'>Non Attivo</span>";
        $stampa = "<h5 class=\"card-title\">Report e limiti newsletter</h5>
        <p>
            Numero di email inviate / residue per il piano acquistato. <br />
            <!--Limite giornaliero: ".$this->nc_limite_giorno." mail <br />-->
            Limite mensile: ".$this->nc_limite." mail <br />
            <!--Email inviate oggi: ".$this->nc_contatore_giorno." mail <br />-->
            Email inviate nel mese: ".$this->nc_contatore_totale." mail <br />
            <!--Email rimanenti oggi: ".$this->EmailRimanentiOggi()." mail <br />-->
            Email rimanenti nel mese: ".$this->EmailRimanentiMese()." mail <br>
            Periodo di validità dal ".date('d/m/Y', $this->nc_data_dal)." al ".date('d/m/Y', $this->nc_data_al)."  <br>
            Stato del servizio: ".$stato." <br>
            Modalità invio: ".$this->nc_sender."<br>
        </p>";
        return $stampa;
    }

}