<?php

class TechnicianDB {
    public static function getTechnicians() {
        $db = Database::getDB();
        $query ='SELECT * FROM technicians
                 ORDER BY techID';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        
        foreach ($rows as $row) {
            $technician = new Technician($row['firstName'],
                                         $row['lastName'],
                                         $row['email'],
                                         $row['phone'],
                                         $row['password']);
            $technician->setID($row['techID']);
            
            $technicians[] = $technician;
        }
        return $technicians;
    }
    
    public static function deleteTechnician($tech_id) {
        $db = Database::getDB();
        $query = 'DELETE FROM technicians WHERE techID = :techID';
        $statement = $db->prepare($query);
        $statement->bindValue(':techID', $tech_id);
        $statement->execute();
        $statement->closeCursor();        
    }
    
    public static function addTechnician($technician) {
        $db = Database::getDB();
        $first_name = $technician->getFirstName();
        $last_name = $technician->getLastName();
        $email = $technician->getEmail();
        $phone = $technician->getPhone();
        $password = $technician->getPassword();
        
        $query = 'INSERT INTO technicians
                 (firstName, lastName, phone, email, password)
              VALUES
                 (:first_name, :last_name, :phone, :email, :password)';
        $statement = $db->prepare($query);
        $statement = $db->prepare($query);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);   
        $statement->execute();
        $statement->closeCursor();
    }
}


?>