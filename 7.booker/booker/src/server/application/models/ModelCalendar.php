<?php
namespace application\models;
use application\core as core;
use application\libs\auth as auth;
use application\libs\dbWork as db;

/**
 *  ModelCalendar prepairs calendar and
 *  event data for controllers from db
 */
class ModelCalendar extends core\Model
{
    protected $auth;
    protected $db;

    /**
     *  Creating instanse of work with db lib
     *  and work with auth lib
     */
    public function __construct()
    {
        $this->auth = new auth\Auth;
        $this->db = new db\PdoWork('Mysql');
    }

    /**
     * @return array
     * Returns rooms wich registred in app
     */
    public function getRooms()
    {
      return $this->db
        ->setSelectVal('id_room, name')
        ->setFromVal('bk_rooms')
        ->sendQueryString();
    }

    /**
     * @param  string
     * @param  string
     * @return array
     * Returns all events in this month
     */
    public function getEvents($year,$month)
    {

      return $result = $this->db
        ->setSelectVal('id_event, id_user as user, id_room as roomId, `desc`,  UNIX_TIMESTAMP(dateTime_start) as startEvent, UNIX_TIMESTAMP(dateTime_end) as endEvent, repeat_flag as recurring,  UNIX_TIMESTAMP(dateTime_created) as dayCreation')
        ->setFromVal('bk_events')
        ->setWhereVal('MONTH(dateTime_start)="'.$month .'" AND YEAR(dateTime_start)="'.$year.'"')
        ->sendQueryString();
 
    }

    /**
     * @param  string
     * @return array
     * Returns event by id, and all info
     *  about this event
     */
    public function getEventById($id)
    {
      return $result = $this->db
        ->setSelectVal('id_event, id_user as user, id_room as roomId, `desc`,  UNIX_TIMESTAMP(dateTime_start) as startEvent, UNIX_TIMESTAMP(dateTime_end) as endEvent, repeat_flag as recurring,  UNIX_TIMESTAMP(dateTime_created) as dayCreation')
        ->setFromVal('bk_events')
        ->setWhereVal('id_event="'.$id.'"')
        ->sendQueryString();
    }

    /**
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @param boolean
     * @param boolean
     * @return boolean
     *  
     *  adds event to db bk_events
     */
    public function addEvent($room, $user, $dayCreation, $start, $end, $desc, $recurring = 'false', $recType = false, $recDuration = false)
    {
        
        $dateStart = date('Y-m-d G:i:s',$start);
        
        $dateEnd = date('Y-m-d G:i:s',$end);

        $dateCreate = date('Y-m-d G:i:s',$dayCreation); 
        
        $addResult = true;
    if($recurring == 'false')
    { 
        $recurring = 0;
        $dayEn = $this->checkEvent($start,$end,$room);
        $weekEnd = $this->checkHolydays($start);
        if($dayEn && $weekEnd)
        {
        $this->db
          ->setInsertVal('bk_events','id_user, id_room, `desc`, dateTime_start, dateTime_end, repeat_flag, dateTime_created')
          ->setValuesVal("'" . $user."','" . $room ."','" . $desc . "','" . $dateStart . "','" . $dateEnd . "','" . $recurring . "','" . $dateCreate . "'")
          ->sendQueryString();
          return $addResult;
        }
        else
        {
          return $addResult = [['start'=>$start,'end'=>$end]];
        }
    }
    else
    {
      $recurring = 1;
      $addResult = [];

      $dayEn = $this->checkEvent($start,$end,$room);
      $weekEnd = $this->checkHolydays($start);

      if($dayEn && $weekEnd)
      {
      $this->db
        ->setInsertVal('bk_events','id_user, id_room, `desc`, dateTime_start, dateTime_end, repeat_flag, dateTime_created')
        ->setValuesVal("'" . $user."','" . $room ."','" . $desc . "','" . $dateStart . "','" . $dateEnd . "','" . $recurring . "','" . $dateCreate . "'")
        ->sendQueryString();
      }
      else
      {
        $arr = ['start'=>$start, 'end'=>$end];
        array_push($addResult,$arr);
      }

      $id = $this->db->getLastIdRecord();
      $recDur = (int)$recDuration;          
      if($recType == '1')//weekly
      {
        $startTime = $start;
        $endTime = $end;
        for($i = 0 ; $i < $recDur; $i++) 
        {
          $startTime = strtotime('+1 weeks',$startTime);
          $endTime = strtotime('+1 weeks',$endTime);
          $dateStart = date('Y-m-d G:i:s',$startTime);
          $dateEnd = date('Y-m-d G:i:s',$endTime);
          
          $dayEn = $this->checkEvent($startTime,$endTime,$room);
          $weekEnd = $this->checkHolydays($startTime);

          if($dayEn && $weekEnd)
          {
            $this->db
              ->setInsertVal('bk_events','id_user, id_room, `desc`, dateTime_start, dateTime_end, repeat_flag, dateTime_created,id_parent')
              ->setValuesVal("'" . $user."','" . $room ."','" . $desc . "','" . $dateStart . "','" . $dateEnd . "','" . $recurring . "','" . $dateCreate . "','" . $id ."'")
              ->sendQueryString();
          }
          else
          {
            $arr = ['start'=>$startTime, 'end'=>$endTime];
            array_push($addResult,$arr);
          }
        }
        return $addResult;

      }

      if($recType == '2')//bi-weekly
      {
        $startTime = $start;
        $endTime = $end;
        for($i = 0 ; $i < $recDur; $i++) 
        {
          $startTime = strtotime('+2 weeks',$startTime);
          $endTime = strtotime('+2 weeks',$endTime);
          $dateStart = date('Y-m-d G:i:s',$startTime);
          $dateEnd = date('Y-m-d G:i:s',$endTime);

          $dayEn = $this->checkEvent($startTime,$endTime,$room);
          $weekEnd = $this->checkHolydays($startTime);

          if($dayEn && $weekEnd)
          {
          $this->db
            ->setInsertVal('bk_events','id_user, id_room, `desc`, dateTime_start, dateTime_end, repeat_flag, dateTime_created,id_parent')
            ->setValuesVal("'" . $user."','" . $room ."','" . $desc . "','" . $dateStart . "','" . $dateEnd . "','" . $recurring . "','" . $dateCreate . "','" . $id ."'")
            ->sendQueryString();
          }
          else
          {
            array_push($addResult,['start'=>$startTime, 'end'=>$endTime]);
          }
        }
        return $addResult;
      }

      if($recType == '3')//monthly
      {
        $startTime = $start;
        $endTime = $end;
        $startTime = strtotime('+1 month',$startTime);
        $endTime = strtotime('+1 month',$endTime);
        $dateStart = date('Y-m-d G:i:s',$startTime);
        $dateEnd = date('Y-m-d G:i:s',$endTime);

        $dayEn = $this->checkEvent($startTime,$endTime,$room);
        $weekEnd = $this->checkHolydays($startTime);

        if($dayEn && $weekEnd)
        {
        $this->db
          ->setInsertVal('bk_events','id_user, id_room, `desc`, dateTime_start, dateTime_end, repeat_flag, dateTime_created,id_parent')
          ->setValuesVal("'" . $user."','" . $room ."','" . $desc . "','" . $dateStart . "','" . $dateEnd . "','" . $recurring . "','" . $dateCreate . "','" . $id ."'")
          ->sendQueryString();
        }
        else
        {
          array_push($addResult,['start'=>$startTime, 'end'=>$endTime]);
         
        }
         return $addResult;
       
      }
      
    }
    }

    /**
     * @param  string
     * @param  string
     * @param  string
     * @param  string
     * @param  string
     * @param  string
     * @param  string
     * @param  boolean
     * @param  boolean
     * @return boolean
     *
     * Updates event by Id, and updates 
     * his siblings or childs
     */
    public function editEvent($room, $user, $dayCreation, $start, $end,$idEvent, $recurring = 'false', $recType = false, $recDuration = false)
    {
        $dateStart = date('Y-m-d G:i:s',$start);
        
        $dateEnd = date('Y-m-d G:i:s',$end);

        $dateCreate = date('Y-m-d G:i:s',$dayCreation); 
        
        
    $addResult = true;
    if($recurring == 'false')
    {
      $dayEn = $this->checkEvent($start,$end,$room,$idEvent);

      if($dayEn)
      {
      $result = $this->db
        ->setUpdateVal('bk_events')
        ->setSetVal("id_user='" . $user."', dateTime_start='" . $dateStart . "',dateTime_end='" . $dateEnd . "',dateTime_created='" . $dateCreate . "'")
        ->setWhereVal("id_event='" . $idEvent . "'")
        ->sendQueryString();
      }
      else
      {
        return $addResult = [['start'=>$start,'end'=>$end]];
      }
    }    
    else
    {
      $addResult = [];

      $dayEn = $this->checkEvent($start,$end,$room,$idEvent);

      if($dayEn)
      {
      $this->db
        ->setUpdateVal('bk_events')
        ->setSetVal("id_user='" . $user."', dateTime_start='" . $dateStart . "',dateTime_end='" . $dateEnd . "',dateTime_created='" . $dateCreate . "'")
        ->setWhereVal("id_event='" . $idEvent . "'")
        ->sendQueryString();
      }
      else
      {
         array_push($addResult,['start'=>$start, 'end'=>$end]);
      }

      $result = $this->db
        ->setSelectVal('id_event,UNIX_TIMESTAMP(dateTime_start) as dateTime_start,UNIX_TIMESTAMP(dateTime_end) as dateTime_end,UNIX_TIMESTAMP(dateTime_created) as dateTime_created')
        ->setFromVal('bk_events')
        ->setWhereVal('id_parent="' . $idEvent . '"')
        ->sendQueryString();

        $selected = $this->db
          ->setSelectVal('id_parent')
          ->setFromVal('bk_events')
          ->setWhereVal('id_event="' . $idEvent . '"')
          ->sendQueryString();

        $beatween = (int)$result[1]['dateTime_start'] - (int)$result[0]['dateTime_start']; 

        if(count($result) == 1)
        {
          $parent = $this->db
        ->setSelectVal('UNIX_TIMESTAMP(dateTime_start) as dateTime_start,UNIX_TIMESTAMP(dateTime_end) as dateTime_end,UNIX_TIMESTAMP(dateTime_created) as dateTime_created')
        ->setFromVal('bk_events')
        ->setWhereVal('id_event="' . $selected[0]['id_parent'] . '"')
        ->sendQueryString();
          $beatween = (int)$result[0]['dateTime_start'] - (int)$parent[0]['dateTime_start']; 
        }

        if(count($result) == 0){

          
        $result = $this->db
        ->setSelectVal('id_event,UNIX_TIMESTAMP(dateTime_start) as dateTime_start,UNIX_TIMESTAMP(dateTime_end) as dateTime_end,UNIX_TIMESTAMP(dateTime_created) as dateTime_created')
        ->setFromVal('bk_events')
        ->setWhereVal('id_parent="' . $selected[0]['id_parent'] . '" AND id_event >"' . $idEvent . '"')
        ->sendQueryString();

          $time = $this->db
        ->setSelectVal('id_event,UNIX_TIMESTAMP(dateTime_start) as dateTime_start,UNIX_TIMESTAMP(dateTime_end) as dateTime_end,UNIX_TIMESTAMP(dateTime_created) as dateTime_created')
        ->setFromVal('bk_events')
        ->setWhereVal('id_parent="' . $selected[0]['id_parent'] . '"')
        ->setLimitVal('2')
        ->sendQueryString();
        $beatween = (int)$time[1]['dateTime_start'] - (int)$time[0]['dateTime_start']; 
        }
         
        
        $startStamp = $start;
        $endStamp = $end;
        
        if($beatween / 86400 > 6 && $beatween / 86400 < 12){
          foreach ($result as $value)
          {
            
            $startStamp = strtotime('+7 days',$startStamp);
            $endStamp = strtotime('+7 days',$endStamp);

            $value['dateTime_start'] = date('Y-m-d G:i:s',$startStamp);
          
            $value['dateTime_end'] = date('Y-m-d G:i:s',$endStamp);


            $dayEn = $this->checkEvent($startStamp,$endStamp,$room,$value['id_event']);

            if($dayEn)
            {
            $this->db
              ->setUpdateVal('bk_events')
              ->setSetVal("id_user='" . $user."', dateTime_start='" . $value['dateTime_start'] . "',dateTime_end='" . $value['dateTime_end'] . "',dateTime_created='" . $value['dateTime_created'] . "'")
              ->setWhereVal("id_event='" . $value['id_event'] . "'")->sendQueryString();
            }
            else
            {
              array_push($addResult,['start'=>$startStamp, 'end'=>$endStamp]);
            }
          }
          return $addResult;
        }

        if($beatween / 86400 > 13 && $beatween / 86400 < 16 ){
          foreach ($result as $value)
          {
            $startStamp = strtotime('+14 days',$startStamp);
            $endStamp = strtotime('+14 days',$endStamp);

            $value['dateTime_start'] = date('Y-m-d G:i:s',$startStamp);
          
            $value['dateTime_end'] = date('Y-m-d G:i:s',$endStamp);

            $dayEn = $this->checkEvent($startStamp,$endStamp,$room,$value['id_event']);

            if($dayEn)
            {
            $this->db
              ->setUpdateVal('bk_events')
              ->setSetVal("id_user='" . $user."', dateTime_start='" . $value['dateTime_start'] . "',dateTime_end='" . $value['dateTime_end'] . "',dateTime_created='" . $value['dateTime_created'] . "'")
              ->setWhereVal("id_event='" . $value['id_event'] . "'")
              ->sendQueryString();
            }
            else
            {
              array_push($addResult,['start'=>$startStamp, 'end'=>$endStamp]);
            }
          } 
          return $addResult;
        }

        if($beatween / 86400 > 16){
          foreach ($result as $value)
          {
            $startStamp = strtotime('+1 month',$startStamp);
            $endStamp = strtotime('+1 month',$endStamp);

            $value['dateTime_start'] = date('Y-m-d G:i:s',$startStamp);
          
            $value['dateTime_end'] = date('Y-m-d G:i:s',$endStamp);

            $dayEn = $this->checkEvent($startStamp,$endStamp,$room,$value['id_event']);

            if($dayEn)
            {
            $this->db
              ->setUpdateVal('bk_events')
              ->setSetVal("id_user='" . $user."', dateTime_start='" . $value['dateTime_start'] . "',dateTime_end='" . $value['dateTime_end'] . "',dateTime_created='" . $value['dateTime_created'] . "'")
              ->setWhereVal("id_event='" . $value['id_event'] . "'")
              ->sendQueryString();
            }
            else
            {
              array_push($addResult,['start'=>$startStamp, 'end'=>$endStamp]);
            }
          } 
          return $addResult;
        }
    }

    }

  /**
   * @param  string
   * @param  string
   * @return array
   *
   * Delete one event or 
   * all events who was created recurring
   */
  public function deleteEvent($id, $recurring = 'false'){

    if($recurring == 'false')
    {
      $result = $this->db
        ->setSelectVal('UNIX_TIMESTAMP(dateTime_start) as start, UNIX_TIMESTAMP(dateTime_end) as end')
        ->setFromVal('bk_events')
        ->setWhereVal('id_event="' . $id .'"')
        ->sendQueryString();

      $this->db
        ->setDeleteVal('bk_events')
        ->setWhereVal('id_event="'.$id.'"')
        ->sendQueryString();
     return $result;
    }
    else
    {
      $check = $this->db
        ->setSelectVal('id_parent')
        ->setFromVal('bk_events')
        ->setWhereVal('id_event="'.$id.'"')
        ->sendQueryString();
      
      $result = $this->db
        ->setSelectVal('UNIX_TIMESTAMP(dateTime_start) as start, UNIX_TIMESTAMP(dateTime_end) as end')
        ->setFromVal('bk_events')
        ->setWhereVal('id_event="' . $id .'" OR id_parent="' . $id . '"')
        ->sendQueryString();

        if($check[0]['id_parent'] != NULL)
        {

          $this->db
            ->setDeleteVal('bk_events')
            ->setWhereVal('id_event="'.$check[0]['id_parent'].'"')
            ->sendQueryString();
          $this->db
            ->setDeleteVal('bk_events')
            ->setWhereVal('id_parent="'.$check[0]['id_parent'] .'"')
            ->sendQueryString();
        }
        else
        {
          
          $this->db
            ->setDeleteVal('bk_events')
            ->setWhereVal('id_event="'.$id.'"')
            ->sendQueryString();
          $this->db
            ->setDeleteVal('bk_events')
            ->setWhereVal('id_parent="'.$id .'"')
            ->sendQueryString(); 
        }
      return $result;    
    }
  }
    /**
     * @param  string
     * @param  string
     * @param  string
     * @param  boolean
     * @return boolean
     *
     * Checks posibility of book event in this time
     */
    public function checkEvent($timestampStart,$timestampEnd,$room,$id = false)
    {
      $day = date('Y-m-d',$timestampStart);
      if($id == false){
      $result = $this->db
        ->setSelectVal('id_event, UNIX_TIMESTAMP(dateTime_start) as start, UNIX_TIMESTAMP(dateTime_end) as end')
        ->setFromVal('bk_events')
        ->setWhereVal('DATE(dateTime_Start)="'.$day.'" AND id_room="'.$room.'"')
        ->sendQueryString();
      }
      else
      {
        $result = $this->db
        ->setSelectVal('id_event, UNIX_TIMESTAMP(dateTime_start) as start, UNIX_TIMESTAMP(dateTime_end) as end')
        ->setFromVal('bk_events')
        ->setWhereVal('DATE(dateTime_Start)="'.$day.'" AND id_room="'.$room.'" AND id_event !="' . $id . '"')
        ->sendQueryString();
      }  
        if(count($result) > 0)
        {
          foreach ($result as $date) 
          {
            if(!((int)$date['start'] < (int)$timestampStart && (int)$date['end'] <= (int)$timestampStart || (int)$date['start'] >= (int)$timestampEnd && (int)$date['end'] > (int)$timestampEnd))
            {
              return false;
            }
          }
          return true;
        }
        else
        {
          return true;
        }
        
    }

    /**
     * @param  string
     * @return boolean
     *
     * Checks event for holyday and 
     * refuse booking in holydays
     */
    public function checkHolydays($timestamp)
    {
        $day = date('N', $timestamp);
        return !((int)$day >= 6); 
        
    }
}
