<?php

class TeamInfoSoap extends ClientSoap
{
    private $teamArray;

    function __construct($url) {
        if(is_string($url))
        {
            parent::__construct($url);
            $this->getTeams();
        }
        else
        {
            throw new Exception(STR_ERR);
        }
    } 

    private function getTeams()
    {
        $client = $this->getClient();
        $this->teamArray = $client->Teams();
    }

    public function getTeamBlock()
    {
        $arr = $this->teamArray->TeamsResult->tTeamInfo;
        $temp .= '<div class="teams">';

        foreach($arr as $obj)
        {
            $temp .= '<div class="one-team">';
            $temp .= '<p class="team-name">' .  $obj->sName . '</p>';
            $temp .= '<img class="team-flag" src="' .  $obj->sCountryFlag . '" alt="">';
            $temp .= '</div>';
        }
        
        $temp .= '</div>';
        return $temp;
    }


}

