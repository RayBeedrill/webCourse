<?php 
class AutoGeekSoap
{
    protected $db;

    public function __construct()
    {
        $this->db = new PdoWork('Mysql');
    }

    /**
     * @return string 
     */
    public function getCarList()
    {
        $query = "SELECT cars.id_car as id, brands.name as brand, cars.model 
        FROM cars LEFT JOIN brands ON cars.id_brand = brands.id_brand";

        $result = $this->db->sendCustomQuery($query,1);
        $json = json_encode($result);
        return $json;
    }
    

    /**
     * @param  int
     * @return string
     */
    public function getCarInfo($id)
    {
        $query = "SELECT cars.id_car as id,
                cars.model,
                brands.name as brand,
                colors.name as color,
                years.year,
                engines.capacity,
                cars.max_speed,
                cars.price
                FROM cars
                LEFT JOIN brands ON brands.id_brand = cars.id_brand
                LEFT JOIN colors ON colors.id_color = cars.id_color
                LEFT JOIN years ON years.id_year = cars.id_year
                LEFT JOIN engines ON engines.id_engine = cars.id_engine 
                WHERE cars.id_car = $id";

        $result = $this->db->sendCustomQuery($query,1);
        $json = json_encode($result);
        return $json;
    }    
    
    /**
     * @param  string
     * @param  string
     * @param  string
     * @param  string
     * @param  string
     * @param  string
     * @return string
     */
    public function getCarBySettings($arr)
    {
        $arr = json_decode($arr,true);
        $year = $arr['year'];
        $color = $arr['color'];
        $model = $arr['model'];
        $brand = $arr['brand'];
        $capacity = $arr['capacity'];
        $maxSpeed = $arr['maxSpeed'];

        
        $query = "SELECT cars.id_car as id,
        cars.model,
        brands.name as brand,
        colors.name as color,
        years.year,
        engines.capacity,
        cars.max_speed,
        cars.price
        FROM cars
        LEFT JOIN brands ON brands.id_brand = cars.id_brand
        LEFT JOIN colors ON colors.id_color = cars.id_color
        LEFT JOIN years ON years.id_year = cars.id_year
        LEFT JOIN engines ON engines.id_engine = cars.id_engine
        WHERE years.id_year = '$year' ";

        if($arr["color"] !== "false")
        {
            $query .= " AND colors.id_color = '$color' ";
        }

        if($arr["model"] !== "false")
        {
            $query .= " AND cars.model = '$model' ";   
        }

        if($arr["brand"] !== "false")
        {
            $query .= " AND brands.id_brand = '$brand' ";
        }

        if($arr["capacity"] !== "false")
        {
            $query .= " AND engines.id_engine = '$capacity' ";
        }

        if($arr["maxSpeed"] !== "false")
        {
            $query .= " AND cars.max_speed = '$maxSpeed' ";
        }

        $result = $this->db->sendCustomQuery($query,1);
        $json = json_encode($result);
        return $json;
    }
    
    /**
     * @return string
     */
    public function getAllFilters()
    {
        $queryArr = array(
            "years" => "SELECT DISTINCT id_year as id, year from years ORDER BY year ASC",
            "colors" => "SELECT DISTINCT id_color as id, name as color from colors",
            "capacity" => "SELECT DISTINCT id_engine as id, capacity from engines ORDER BY capacity ASC",
            "models" => "SELECT DISTINCT id_car as id, model from cars",
            "maxSpeed" => "SELECT DISTINCT id_car as id, max_speed from cars ORDER BY max_speed ASC",
            "brands" => "SELECT DISTINCT id_brand as id, name as brand from brands",
         );
        $result = [];
        foreach ($queryArr as $key => $query) {
            $resultDB = $this->db->sendCustomQuery($query,1);
            $result[$key] = $resultDB;    
        }
        $json = json_encode($result);
        return $json;
    }

    /**
     * @return string
     */
    public function getAllPaymentMethods()
    {
        $query = "SELECT id_method as id, name as method from payment_method";
        $result = $this->db->sendCustomQuery($query,1);
        $json = json_encode($result);
        return $json;
    }

    /**
     * @param  int
     * @param  string
     * @param  string
     * @param  string
     * @return string
     */
    public function buyCar($arr)
    {
        $arr = json_decode($arr,true);
        
        $name = $arr['name'];
        $secName = $arr['secName'];
        $idCar = $arr['id_car'];
        $idMethod = $arr['id_method'];

        if(strlen($idCar) > 0 &&
         strlen($name) > 0 &&
         strlen($secName) > 0 &&
         strlen($idMethod) > 0)
        {
            $query = "INSERT INTO customers (first_name, second_name, id_car, id_method) VALUES
             ('$name','$secName','$idCar','$idMethod')";
            $this->db->sendCustomQuery($query,0);
            return "true";
        }
        else
        {
            throw new Exception(BUY_ERR);
        }

    }
    
    public function __destruct()
    {
        unset($this->db);
    }
}