<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-4xl mx-auto py-10">
  <h1 class="text-3xl font-bold mb-4 text-purple-600">Users List 👥</h1>

  <ul class="space-y-2">
   <?php echo htmlspecialchars($user['name']); ?>
   <form method="POST" action="/users/delete/<?php echo htmlspecialchars($user['id']); ?>">
  <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
    🗑️ Delete User
  </button>
</form>


  </ul>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
