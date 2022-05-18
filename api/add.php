<?php
    $conn = new mysqli('localhost', 'root', '', 'angular');
 
    $data = json_decode(file_get_contents("php://input"));
 
    $out = array(
        'error' => false,
        'title' => false,
        'description' => false,
        'cover_img_path' => false,
        'owner' => false,
        'room_number' => false,
        'area' => false,
        'price' => false,
        'currency' => false,
        'address' => false
    );
    $firstname = $data->firstname;
    $lastname = $data->lastname;
    $address = $data->address;
    if (empty($data->title)) {
        $out['title'] = true;
        $out['message'] = 'Title is required';
    } elseif (empty($data->description)) {
        $out['description'] = true;
        $out['message'] = 'Description is required';
    } elseif(empty($data->cover_img_path)) {
        $out['cover_img_path'] = true;
        $out['message'] = 'Cover image is required';
    } elseif(empty($data->owner)) {
        $out['owner'] = true;
        $out['message'] = 'Owner is required';
    } elseif(empty($data->room_number)) {
        $out['room_number'] = true;
        $out['message'] = 'Room number is required';
    } elseif(empty($data->area)) {
        $out['area'] = true;
        $out['message'] = 'Area is required';
    } elseif(empty($data->price)) {
        $out['price'] = true;
        $out['message'] = 'Price is required';
    } elseif(empty($data->currency)) {
        $out['currency'] = true;
        $out['message'] = 'Currency is required';
    } elseif(empty($data->address)) {
        $out['address'] = true;
        $out['message'] = 'Address is required';
    }
    } else {
        $stmt = $conn->prepare("INSERT INTO estates (title, description, cover_img_path, owner, room_number, area, price, currency, address) VALUES (?,?,?,?,?,?,?,?,?);";
        $stmt->bind_params("ssssiiiss",
            $data->title,
            $data->description,
            $data->cover_img_path,
            $data->owner,
            $data->room_number,
            $data->area,
            $data->price,
            $data->currency,
            $data->address)
        if ($stmt->execute()) {
            $out['message'] = 'Member Added Successfully';
        } else {
            $out['error'] = true;
            $out['message'] = "Cannot Add Member, error: '$conn->error'";
        }
    }
    echo json_encode($out);
?>
