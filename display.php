<?php include 'top.php'?>
<link rel='import' href="top.html">
<div id="app2">
    <div v-if='fail === 1' id="errorMessage">
        <h1>No Tape Found</h1>
    </div>
    <div  v-if='fail === 0' id='passEnter'>
        <form method="POST" id='passwordForm'>
            <input v-model="pass" class='passdEntry' required><br>
            <input type='submit' value='Enter Password'>
        </form>
    </div>
    <div  v-if='fail === 0' id='tapeShow'>
        <h1>Hello Agent: {{ rName }}</h1>
        <h3>The following Tape has been approved for your eyes only: </h3>
        <p>{{ tape }}</p>
        <h3>Tape sent by: </h3>
        <h2>Agent: {{ yName }}</h2>
    </div>
</div>
<?php include("bottom.php"); ?>
