<form method="POST" action="{{ route('teacher.login') }}">
@csrf
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login as Teacher</button>
</form>
