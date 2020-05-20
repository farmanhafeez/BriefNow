<?php

require '../dbconfig.php';

//Delete user
if (isset($_POST['action']) && $_POST['action'] == 'deleteuser') {
    $userid = $_POST['userid'];
    if (empty($userid)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
    } else {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("s", $userid);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
        } else {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> user deleted successfully']);
        }
    }
}

//Delete blog post
if (isset($_POST['action']) && $_POST['action'] == 'deletepost') {
    $postid = $_POST['postid'];
    if (empty($postid)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
    } else {
        //Delete post thumbnail image
        $stmt3 = $conn->prepare("SELECT * FROM blog WHERE postid = ?");
        $stmt3->bind_param("s", $postid);
        $stmt3->execute();
        $result = $stmt3->get_result();
        $row = $result->fetch_array();
        $thumbnail = '../' . $row['thumbnail'];
        chmod('../upload', 0777);
        if (!unlink($thumbnail)) {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> Image cannot be deleted']);
        } else {
            $stmt = $conn->prepare("DELETE FROM blog WHERE postid = ?");
            $stmt->bind_param("s", $postid);
            if (!$stmt->execute()) {
                echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
            } else {
                //Delete post comments
                $stmt1 = $conn->prepare("DELETE FROM comment WHERE commentpostid = ?");
                $stmt1->bind_param("s", $postid);
                $stmt1->execute();
                //Delete post comments reply
                $stmt2 = $conn->prepare("DELETE FROM commentreply WHERE postid = ?");
                $stmt2->bind_param("s", $postid);
                $stmt2->execute();
                echo json_encode(["status" => 4, "msg" => '<i class="fas fa-check-circle"></i> Post deleted successfully']);
            }
        }
    }
}

//Delete comment
if (isset($_POST['action']) && $_POST['action'] == 'deletecomment') {
    $commentid = $_POST['commentid'];
    if (empty($commentid)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
    } else {
        $stmt = $conn->prepare("DELETE FROM comment WHERE commentid = ?");
        $stmt->bind_param("s", $commentid);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
        } else {
            $stmt1 = $conn->prepare("DELETE FROM commentreply WHERE commentid = ?");
            $stmt1->bind_param("s", $commentid);
            $stmt1->execute();
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> comment deleted successfully']);
        }
    }
}

//Delete reply
if (isset($_POST['action']) && $_POST['action'] == 'deletereply') {
    $replyid = $_POST['replyid'];
    if (empty($replyid)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
    } else {
        $stmt = $conn->prepare("DELETE FROM commentreply WHERE replyid = ?");
        $stmt->bind_param("s", $replyid);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
        } else {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> reply deleted successfully']);
        }
    }
}

//Delete contact
if (isset($_POST['action']) && $_POST['action'] == 'deletecontact') {
    $contactid = $_POST['contactid'];
    if (empty($contactid)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
    } else {
        $stmt = $conn->prepare("DELETE FROM contact WHERE contactid = ?");
        $stmt->bind_param("s", $contactid);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
        } else {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> contact deleted successfully']);
        }
    }
}

//Delete feedback
if (isset($_POST['action']) && $_POST['action'] == 'deletefeedback') {
    $feedid = $_POST['feedid'];
    if (empty($feedid)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
    } else {
        $stmt = $conn->prepare("DELETE FROM feedback WHERE feedid = ?");
        $stmt->bind_param("s", $feedid);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
        } else {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> Feedback deleted successfully']);
        }
    }
}

//Delete pagevisitor data
if (isset($_POST['action']) && $_POST['action'] == 'deletevisitor') {
    $visitorid = $_POST['visitorid'];
    if (empty($visitorid)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
    } else {
        $stmt = $conn->prepare("DELETE FROM pagevisitor WHERE visitorid = ?");
        $stmt->bind_param("s", $visitorid);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
        } else {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> Page visitor data deleted successfully']);
        }
    }
}

//Delete trafficsource data
if (isset($_POST['action']) && $_POST['action'] == 'deletetraffic') {
    $trafficid = $_POST['trafficid'];
    if (empty($trafficid)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
    } else {
        $stmt = $conn->prepare("DELETE FROM trafficsource WHERE id = ?");
        $stmt->bind_param("s", $trafficid);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
        } else {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> Page visitor data deleted successfully']);
        }
    }
}

//Delete newsletter data
if (isset($_POST['action']) && $_POST['action'] == 'deletenewsletter') {
    $newsletterid = $_POST['newsletterid'];
    if (empty($newsletterid)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
    } else {
        $stmt = $conn->prepare("DELETE FROM newsletter WHERE subscription_id = ?");
        $stmt->bind_param("s", $newsletterid);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
        } else {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> Page visitor data deleted successfully']);
        }
    }
}
