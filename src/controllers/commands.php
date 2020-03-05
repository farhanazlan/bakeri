<?php

//get all items
function getAllbakeri($db)
{
    $sql = 'Select * from bakeri';
    $stmt = $db->prepare ($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get bakeri by name
function getbakeri($db, $foodname)
{
$sql = 'Select * from bakeri Where food_name = :name';
$stmt = $db->prepare ($sql);
$name = $foodname;
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get bakeri by category
function getbakericategory($db, $foodcategory)
{
$sql = 'Select * from bakeri Where food_category = :category';
$stmt = $db->prepare ($sql);
$category = $foodcategory;
$stmt->bindParam(':category', $category, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//Create new item
function createbakeri($db,$form_data)

{
    $sql = 'INSERT INTO bakeri (`food_name`, `food_price`, `food_category`) VALUES (:name, :price, :category)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $form_data['food_name']);
    $stmt->bindParam(':price', $form_data['food_price']);
    $stmt->bindParam(':category', $form_data['food_category']);
    $stmt->execute();
    return $db->lastInsertID(); //Insert last number 
} 


//delete product by id
function deletebakeri($db,$foodname) 

{
    $sql = 'DELETE from bakeri where food_name = :name';
    $stmt = $db->prepare($sql);
    $name = $foodname;
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    }
    
//update product by id
function updatebakeri($db,$form_dat,$foodname) {
    $sql = 'UPDATE bakeri SET food_price = :price , food_category = :category ';
    $sql .=' WHERE food_name = :name';

    $stmt = $db->prepare ($sql);
    $name = $foodname;
  

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':price', $form_dat['food_price']);
    $stmt->bindParam(':category', $form_dat['food_category']);
    //$stmt->bindParam(':modified', $mod , PDO::PARAM_STR);
    $stmt->execute();
    
$sql1 = 'Select * from bakeri Where food_name = :name';
$stmt1 = $db->prepare ($sql1);
$name = $foodname;
$stmt1->bindParam(':name', $name, PDO::PARAM_STR);
$stmt1->execute();
return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    
    }
    

