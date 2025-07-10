<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-4xl mx-auto py-10">
  <h1 class="text-3xl font-bold mb-4 text-purple-600">Users List 👥</h1>

  <ul class="space-y-2">
    <?php foreach ($users as $user): ?>
      <li class="p-4 bg-white rounded shadow">
        <?php echo htmlspecialchars($user['name']); ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
