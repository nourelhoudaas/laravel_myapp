  <!DOCTYPE html>
  <html>
  <head>
      <title>Mise à jour mot de pass</title>
  </head>
  <body>
    <h1>Modifier le mot de pass</h1>
    <form method="POST" action="{{ route('password_update') }}">
    @csrf
    <label for="current_password">Ancien mot de pass:</label>
      <input type="password" id="current_password" name="current_password" required>

      <label for="new_password">Nouveau mot de pass:</label>
      <input type="password" id="new_password" name="new_password" required>

      <label for="new_password_confirmation">Confirm New Password:</label>
      <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>

      <button type="submit">Update Password</button>
    </form>
  </body>
  </html>
