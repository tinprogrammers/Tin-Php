<?php
namespace App\Controllers;

use App\Models\Post;

class PostController {

  /**
   * GET /posts
   * Sab records ko DB se get karta hai aur view load karta hai.
   */
  public function index() {
    $posts = Post::all();
    include __DIR__ . '/../../Views/posts/index.php';
  }

  /**
   * GET /posts/show?id=1
   * Ek single record get karta hai aur view load karta hai.
   */
  public function show($id) {
    $record = Post::find($id);
    include __DIR__ . '/../../Views/posts/show.php';
  }

  /**
   * POST /posts/store
   * Naya record create karta hai aur redirect karta hai.
   */
  public function store() {
    // Request data
    $data = [
      'column1' => $_POST['column1'],
      'column2' => $_POST['column2']
    ];

    Post::create($data);

    header("Location: /posts");
    exit;
  }

  /**
   * POST /posts/update?id=1
   * Existing record ko update karta hai aur redirect karta hai.
   */
  public function update($id) {
    $data = [
      'column1' => $_POST['column1'],
      'column2' => $_POST['column2']
    ];

    Post::update($id, $data);

    header("Location: /posts/show?id=$id");
    exit;
  }

  /**
   * POST /posts/delete?id=1
   * Record ko DB se delete karta hai aur redirect karta hai.
   */
  public function destroy($id) {
    $record = Post::find($id);

    if ($record) {
      Post::delete($id);
      include __DIR__ . '/../../Views/posts/delete.php';
      exit;
    } else {
      echo "❌ Record not found.";
      exit;
    }
  }

}