<?php
class User {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function createUser($data) {
    $sql = "INSERT INTO users (user_name, user_username, user_email, user_password) VALUES (?, ?, ?, ?)";
  
    $stmt = $this->db->pdo->prepare($sql);
  
    $stmt->bindParam(1, $data['user_name'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['user_username'], PDO::PARAM_STR);
    $stmt->bindParam(3, $data['user_email'], PDO::PARAM_STR);
    $stmt->bindParam(4, $data['user_password'], PDO::PARAM_STR);
  
    if($stmt->execute()) {
      return true;
    }
    
    return false;
  }

  public function logIn($data) {
    $sql = "SELECT * FROM users WHERE user_username = ?";
  
    $stmt = $this->db->pdo->prepare($sql);
  
    $stmt->bindParam(1, $data['user_username'], PDO::PARAM_STR);
  
    $stmt->execute();
  
    if($row = $stmt->fetch()) {
      if(password_verify($data['user_password'], $row->user_password)) {
        return true;
      }
    }
    
    return false;
  }

  public function logOut($session) {
    unset($session);

    session_destroy();
  }

  public function loggedIn() {
    return isset($_SESSION['user']) ? true : false;
  }

  public function getUser($user) {
    if(is_numeric($user)) {
      $sql = "SELECT * FROM users WHERE user_id = ?";

      $stmt = $this->db->pdo->prepare($sql);

      $stmt->bindParam(1, $user, PDO::PARAM_INT);
    } else {
      $sql = "SELECT * FROM users WHERE user_username = ?";

      $stmt = $this->db->pdo->prepare($sql);

      $stmt->bindParam(1, $user, PDO::PARAM_STR);
    }

    if($stmt->execute()) {
      return $stmt->fetch();
    }

    return false;
  }

  public function follow($user, $follow) {
    $sql = "INSERT INTO follows (follow_user, follow_follow) VALUES (?, ?)";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $user, PDO::PARAM_INT);
    $stmt->bindParam(2, $follow, PDO::PARAM_INT);

    if($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function unfollow($user, $follow) {
    $sql = "DELETE FROM follows WHERE follow_user = ? AND follow_follow = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $user, PDO::PARAM_INT);
    $stmt->bindParam(2, $follow, PDO::PARAM_INT);

    if($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function getFollows($profile) {
    $sql = "SELECT * FROM follows WHERE follow_follow = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $profile, PDO::PARAM_INT);

    if($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return false;
  }

  public function searchUsers($keywords) {
    $sql = "SELECT
              *
            FROM
              users
            WHERE
              user_name
            LIKE
              ?
            OR
              user_username
            LIKE
              ?
            ORDER BY
              user_created
            DESC";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $keywords, PDO::PARAM_STR);
    $stmt->bindParam(2, $keywords, PDO::PARAM_STR);

    if($stmt->execute()) {
      return $stmt->fetchAll();
    }

    return false;
  }

  public function updateProfile($data, $user) {
    $sql = "UPDATE users SET user_name = ?, user_username = ?, user_email = ? WHERE user_id = ?";
  
    $stmt = $this->db->pdo->prepare($sql);
  
    $stmt->bindParam(1, $data['user_name'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['user_username'], PDO::PARAM_STR);
    $stmt->bindParam(3, $data['user_email'], PDO::PARAM_STR);
    $stmt->bindParam(4, $user, PDO::PARAM_INT);
  
    if($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function updateProfilePicture($picture, $user) {
    $sql = "UPDATE users SET user_profile_picture = ? WHERE user_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $picture, PDO::PARAM_STR);
    $stmt->bindParam(2, $user, PDO::PARAM_INT);

    if($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function updatePassword($password, $user) {
    $sql = "UPDATE users SET user_password = ? WHERE user_id = ?";
  
    $stmt = $this->db->pdo->prepare($sql);
  
    $stmt->bindParam(1, $password, PDO::PARAM_STR);
    $stmt->bindParam(2, $user, PDO::PARAM_INT);

    if($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function deleteProfile($user) {
    $sql = "DELETE FROM users WHERE user_id = ?";
  
    $stmt = $this->db->pdo->prepare($sql);
  
    $stmt->bindParam(1, $user, PDO::PARAM_INT);
  
    if($stmt->execute()) {
      return true;
    }

    return false;
  }
}