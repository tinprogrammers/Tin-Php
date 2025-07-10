<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-4xl mx-auto py-20 text-center">
  <h1 class="text-4xl font-bold mb-6 text-red-600">Sorry to see you go 😢</h1>
  <p class="text-lg mb-6">
    User <strong><?php echo htmlspecialchars($username); ?></strong> has been deleted.
  </p>
  <a href="/users" class="inline-block bg-purple-600 text-white px-6 py-3 rounded hover:bg-purple-700">
    🔙 Go Back to Users List
  </a>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
