<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles.css">
</head>

<body>

  <section>
    <div class="body">
      <header>
        <div>
          <img src="../../../assets/images/bot.png" alt="bot image">
          <span class="chatbot-user">Botyuda</span>
        </div>
        <a href="../userProfile.php" class="text-decoration-none">Volver</a>
      </header>
      <main>
        <div class="ai-chatbot">
          <img src="../../../assets/images/bot.png" alt="">
          <div class="message">
            <p>Hola
              <span class="text-primary">
                <?php if (!empty($_SESSION["user"])) {
                  echo $_SESSION["user"];
                }
                ?>
              </span> que tal? en que te puedo ayudar? =D
            </p>
            <small class="botDate"></small>
          </div>
        </div>
      </main>
      <footer>
        <form action="" method="POST">
          <input type="text" placeholder="write message">
          <button>send</button>
        </form>
      </footer>
    </div>
  </section>
</body>

</html>

<script>
  let main = document.querySelector("main");
  let button = document.querySelector("button");
  let form = document.querySelector("form");
  let data = document.querySelector("input");
  let botDate = document.querySelector(".botDate");

  let startDate = new Date();
  botDate.append(startDate.toLocaleTimeString())

  //query
  button.onclick = e => {
    e.preventDefault();

    let date = new Date();

    const ajax = new XMLHttpRequest();
    ajax.open("POST", "message.php", true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onload = function() {
      if (ajax.status === 200) {
        console.log("status ready");
        main.innerHTML += `<div class="user-mes"> <div class="message">
                        <p> ` + data.value + `</p>
                        <small class="time">` + date.toLocaleTimeString() + `</small>
                    </div>
                    <img src="../../../assets/images/user.png" alt="bot img">
                </div> 
                <div class="ai-chatbot"> <img src="../../../assets/images/bot.png" alt="user img">
                    <div class="message">
                        <p>` + this.responseText + ` </p>
                        <small>` + date.toLocaleTimeString() + `</small>
                    </div>
                </div>`;
        form.reset();
        main.scrollBy(0, 1000);
      } else {
        console.log("status is not ready");
      }
    }
    const message = "message=" + data.value;
    ajax.send(message);
  }
</script>