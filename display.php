<?php include 'top.php'?>
<div id="app2">
    <h1 class='displayTitle' v-if='fail === 1'>No Tape Found</h1>
    <h1 class='displayTitle' v-if='fail === 0'>We have a tape for You</h1>
    <h3 class='displaySubTitle' v-if='fail === 0'>But We'll need a password first</h3>
    <div class='entry' v-if='fail === 0' id='passEnter'>
        <form @submit.prevent="verifyTape">
            <input v-model="pass" class='nameEntry' placeholder='Password' required><br>
            <button type='submit'><i class="fas fa-step-forward"></i></button>
        </form>
    </div>
    <div  v-if='success === 1' id='tapeShow'>
        <h1>Hello Agent: {{ rName }}</h1>
        <h3>The following Tape has been approved for your eyes only: </h3>
        <p>{{ tape }}</p>
        <h3>Tape sent by: </h3>
        <h2>Agent: {{ yName }}</h2>
    </div>
</div>
<?php include("bottom.php"); ?>
