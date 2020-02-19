<!DOCTYPE html>
<html>
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bgimg {
  background-color: #008ae6;
  height: 100%;
  background-position: center;
  background-size: cover;
  position: relative;
  color: white;
  font-family: "Courier New", Courier, monospace;
  font-size: 25px;
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
}

.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

hr {
  margin: auto;
  width: 40%;
}
</style>
<body>

<div class="bgimg">
  <div class="topleft">
    <p>Logo</p>
  </div>
  <div class="middle">
    <h1>COMING SOON <?= $firstname .' '. $lastname .' - '. $email ?></h1>
    <hr>
    <p>
    	<?php 
    		foreach ($users as $user) {
    			echo implode(' , ', $user);
    		}
    	?>
    </p>
  </div>
  <div class="bottomleft">
    <p>Some text</p>
  </div>
</div>

</body>
</html>
