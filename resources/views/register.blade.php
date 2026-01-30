<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login & Register</title>

<style>
*{
  box-sizing:border-box;
  font-family:'Segoe UI',sans-serif;
}

body{
  margin:0;
  height:100vh;
  background:linear-gradient(135deg,#141e30,#243b55);
  display:flex;
  align-items:center;
  justify-content:center;
  overflow:hidden;
}

/* BUBBLE BACKGROUND */
.bubble{
  position:absolute;
  width:120px;
  height:120px;
  background:rgba(255,255,255,0.15);
  border-radius:50%;
  animation:float 6s infinite ease-in-out;
}
.bubble:nth-child(1){top:10%;left:15%;}
.bubble:nth-child(2){bottom:20%;right:10%;animation-delay:2s;}
.bubble:nth-child(3){top:50%;right:30%;animation-delay:4s;}

@keyframes float{
  0%{transform:translateY(0);}
  50%{transform:translateY(-30px);}
  100%{transform:translateY(0);}
}

/* CONTAINER */
.container{
  width:760px;
  height:420px;
  background:#fff;
  border-radius:15px;
  box-shadow:0 20px 40px rgba(0,0,0,0.3);
  position:relative;
  overflow:hidden;
}

/* FORM */
.form{
  position:absolute;
  width:50%;
  height:100%;
  padding:40px;
  top:0;
  transition:0.6s ease;
}

.form h2{
  text-align:center;
  margin-bottom:20px;
}

.form input{
  width:100%;
  padding:10px;
  margin:10px 0;
  border-radius:8px;
  border:1px solid #ccc;
}

.form input:focus{
  border-color:#1e90ff;
  box-shadow:0 0 6px rgba(30,144,255,0.4);
  outline:none;
}

.form button{
  width:100%;
  padding:12px;
  margin-top:10px;
  border:none;
  background:#1e90ff;
  color:white;
  font-size:16px;
  border-radius:8px;
  cursor:pointer;
  transition:0.3s;
}

.form button:hover{
  transform:scale(1.05);
  background:#00bfff;
}

/* LOGIN & REGISTER POSITION */
.login{
  left:0;
  z-index:2;
}

.register{
  left:0;
  opacity:0;
  z-index:1;
}

/* ACTIVE STATE */
.container.active .login{
  transform:translateX(100%);
  opacity:0;
}

.container.active .register{
  transform:translateX(100%);
  opacity:1;
  z-index:2;
}

/* OVERLAY */
.overlay{
  position:absolute;
  width:50%;
  height:100%;
  right:0;
  background:linear-gradient(135deg,#141e30,#243b55);
  color:white;
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  padding:40px;
  transition:0.6s ease;
}

.container.active .overlay{
  transform:translateX(-100%);
}

.overlay button{
  margin-top:15px;
  padding:10px 25px;
  border-radius:20px;
  background:transparent;
  border:2px solid white;
  color:white;
  cursor:pointer;
}

.error-msg{
  color:red;
  font-size:0.85rem;
  margin-top:5px;
  text-align:center;
}
</style>
<style>
.mobile-text {
  display: none;
  margin-top: 15px;
  font-size: 0.9rem;
}

.mobile-text span {
  color: #1e90ff;
  font-weight: 600;
  cursor: pointer;
}

/* Responsive */
@media (max-width: 768px) {
  .container {
    width: 90%;
    height: auto;
    min-height: 500px;
  }

  .form {
    width: 100%;
    padding: 30px;
  }

  .overlay {
    display: none;
  }

  .mobile-text {
    display: block;
  }

  /* Reset transform for mobile to avoid sliding off-screen */
  .container.active .login {
    transform: none;
    opacity: 0;
    pointer-events: none;
  }

  .container.active .register {
    transform: none;
    opacity: 1;
    z-index: 5;
    pointer-events: all;
  }

  .login {
    opacity: 1;
    pointer-events: all;
  }

  .register {
    opacity: 0;
    pointer-events: none;
  }
}
</style>
</head>

<body>

<div class="bubble"></div>
<div class="bubble"></div>
<div class="bubble"></div>

<div class="container" id="container">

  <!-- LOGIN -->
  <div class="form login">
    <h2>Login</h2>
    <form action="{{ route('auth.login') }}" method="POST">
      @csrf
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      @if($errors->has('email'))
        <div class="error-msg">{{ $errors->first('email') }}</div>
      @endif
      @if($errors->has('password'))
        <div class="error-msg">{{ $errors->first('password') }}</div>
      @endif
      @if($errors->has('auth'))
        <div class="error-msg">{{ $errors->first('auth') }}</div>
      @endif
      <button type="submit">Login</button>
      <p class="mobile-text">Belum punya akun? <span onclick="toggle()">Daftar sekarang</span></p>
    </form>
  </div>

  <!-- REGISTER -->
  <div class="form register">
    <h2>Register</h2>
    <form action="{{ route('auth.register') }}" method="POST">
      @csrf
      <input type="text" name="name" placeholder="Nama Lengkap" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
      @if($errors->has('name'))
        <div class="error-msg">{{ $errors->first('name') }}</div>
      @endif
      @if($errors->has('email'))
        <div class="error-msg">{{ $errors->first('email') }}</div>
      @endif
      @if($errors->has('password'))
        <div class="error-msg">{{ $errors->first('password') }}</div>
      @endif
      <button type="submit">Daftar</button>
      <p class="mobile-text">Sudah punya akun? <span onclick="toggle()">Login disini</span></p>
    </form>
  </div>

  <!-- OVERLAY -->
  <div class="overlay">
    <div id="overlayText">
      <h2>Halo, Teman!</h2>
      <p>Belum punya akun?</p>
      <button onclick="toggle()">Register</button>
    </div>
  </div>

</div>

<script>
const container = document.getElementById("container");
const overlayText = document.getElementById("overlayText");

function toggle(){
  container.classList.toggle("active");

  if(container.classList.contains("active")){
    overlayText.innerHTML = `
      <h2>Selamat Datang!</h2>
      <p>Sudah punya akun?</p>
      <button onclick="toggle()">Login</button>
    `;
  }else{
    overlayText.innerHTML = `
      <h2>Halo, Teman!</h2>
      <p>Belum punya akun?</p>
      <button onclick="toggle()">Register</button>
    `;
  }
}

// Hapus function register(), login(), dan auto-login!
</script>
</body>
</html>
