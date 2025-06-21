<form action="/login" method="POST">
    @csrf
    <input name="email" placeholder="Email" type="email">
    <input name="password" placeholder="Password" type="password">
    <button type="submit">Login</button>
</form>