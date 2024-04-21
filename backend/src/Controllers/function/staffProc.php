<?php 
//get all staff 
function getAllstaff($db) {

    
    $sql = 'Select * FROM staff'; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

//get staff by id 
function getstaff($db, $staffId) {

    $sql = 'Select o.staffID, o.staffName, o.staffEmail, o.staffPhone, o.yearsOS FROM staff o  ';
    $sql .= 'Where o.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $staffId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

//add new staff 
function createstaff($db, $form_data) { 
    //stop at sisni
    $sql = 'Insert into staff ( staffID, staffName, staffEmail, staffPhone, yearsOS)'; 
    $sql .= 'values (:staffID, :staffName, :staffEmail, :staffPhone, :yearsOS)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':staffID', $form_data['staffID']);  
    $stmt->bindParam(':staffName', ($form_data['staffName']));
    $stmt->bindParam(':staffEmail', ($form_data['staffEmail']));
    $stmt->bindParam(':staffPhone', ($form_data['staffPhone']));
    $stmt->bindParam(':yearsOS', ($form_data['yearsOS']));
    $stmt->execute(); 
    return $db->lastInsertID();
}


//delete staff by id 
function deletestaff($db,$staffId) { 

    $sql = ' Delete from staff where id = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$staffId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

//update staff by id 
function updatestaff($db,$form_dat,$staffId) { 

    
    $sql = 'UPDATE staff SET staffID = :staffID, staffName = :staffName , staffEmail = :staffEmail , staffPhone = :staffPhone , yearsOS = :yearsOS'; 
    $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$staffId;  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':staffID', $form_dat['staffID']);    
    $stmt->bindParam(':staffName', ($form_dat['staffName']));
    $stmt->bindParam(':staffEmail', ($form_dat['staffEmail']));
    $stmt->bindParam(':staffPhone', ($form_dat['staffPhone']));
    $stmt->bindParam(':yearsOS', ($form_dat['yearsOS']));
    $stmt->execute(); 
}