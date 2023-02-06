<?php
class Post {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function createPost($data) {
    $sql = "INSERT INTO posts (post_content, post_by) VALUES (?, ?)";
  
    $stmt = $this->db->pdo->prepare($sql);
  
    $stmt->bindParam(1, $data['post_content'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['post_by'], PDO::PARAM_INT);
  
    if($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function getHomepagePosts($user) {
    $sql = "SELECT
              *
            FROM
              posts
            LEFT JOIN
              users
            ON
              users.user_id = posts.post_by
            WHERE
              (posts.post_by = users.user_id AND users.user_id = ?)
            OR
              (posts.post_by = users.user_id AND posts.post_by
            IN
              (SELECT
                follow_follow
              FROM
                follows
              WHERE
                follow_user = ?))
            ORDER BY
              post_date
            DESC";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $user, PDO::PARAM_INT);
    $stmt->bindParam(2, $user, PDO::PARAM_INT);

    if($stmt->execute()) {
      return $stmt->fetchAll();
    }

    return false;
  }

  public function getAllPosts() {
    $sql = "SELECT * FROM posts LEFT JOIN users ON users.user_id = posts.post_by ORDER BY post_date DESC";

    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute()) {
      return $stmt->fetchAll();
    }

    return false;
  }

  public function getProfilePosts($profile) {
    $sql = "SELECT * FROM posts LEFT JOIN users ON users.user_id = posts.post_by WHERE post_by = ? ORDER BY post_date DESC";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $profile, PDO::PARAM_INT);

    if($stmt->execute()) {
      return $stmt->fetchAll();
    }

    return false;
  }

  public function getPost($post) {
    $sql = "SELECT * FROM posts LEFT JOIN users ON users.user_id = posts.post_by WHERE post_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $post, PDO::PARAM_INT);

    if($stmt->execute()) {
      return $stmt->fetch();
    }

    return true;
  }

  public function editPost($data) {
    $sql = "UPDATE posts SET post_content = ?, post_by = ? WHERE post_id = ?";
  
    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $data['post_content'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['post_by'], PDO::PARAM_INT);
    $stmt->bindParam(3, $data['post_id'], PDO::PARAM_INT);

    if($stmt->execute()) {
      return true;
    }

    return true;
  }

  public function deletePost($post) {
    $sql = "DELETE FROM posts WHERE post_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $post, PDO::PARAM_INT);

    if($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function createReply($data) {
    $sql = "INSERT INTO replies (reply_content, reply_by, reply_post) VALUES (?, ?, ?)";
  
    $stmt = $this->db->pdo->prepare($sql);
  
    $stmt->bindParam(1, $data['reply_content'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['reply_by'], PDO::PARAM_INT);
    $stmt->bindParam(3, $data['reply_post'], PDO::PARAM_INT);
  
    if($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function getReplies($post) {
    $sql = "SELECT * FROM replies LEFT JOIN users ON users.user_id = replies.reply_by WHERE reply_post = ? ORDER BY reply_date DESC";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $post, PDO::PARAM_INT);

    if($stmt->execute()) {
      return $stmt->fetchAll();
    }

    return false;
  }

  public function getReply($reply) {
    $sql = "SELECT * FROM replies WHERE reply_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $reply, PDO::PARAM_INT);

    if($stmt->execute()) {
      return $stmt->fetch();
    }

    return false;
  }

  public function editReply($reply) {
    $sql = "UPDATE replies SET reply_content = ?, reply_by = ? WHERE reply_id = ?";
  
    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $reply['reply_content'], PDO::PARAM_STR);
    $stmt->bindParam(2, $reply['reply_by'], PDO::PARAM_INT);
    $stmt->bindParam(3, $reply['reply_id'], PDO::PARAM_INT);

    if($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function deleteReply($reply) {
    $sql = "DELETE FROM replies WHERE reply_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $reply, PDO::PARAM_INT);

    if($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function searchPosts($keywords) {
    $sql = "SELECT
              *
            FROM
              posts
            LEFT JOIN
              users
            ON
              users.user_id = posts.post_by
            WHERE
              post_content
            LIKE
              ?
            ORDER BY
              post_date
            DESC";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $keywords, PDO::PARAM_STR);
  
    if($stmt->execute()) {
      return $stmt->fetchAll();
    }

    return false;
  }
}