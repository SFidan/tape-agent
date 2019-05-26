<?php include 'top.php'?>
<div v-cloak id="app2">

        <div>
            <h1 class='displayTitle initial' v-bind:class="{ active: isActive}" v-if='fail === 1'>No
                Tape Found</h1>
            <h1 class='displayTitle initial' v-bind:class="{ active: isActive}" v-if='fail === 0'>We
                have a tape for You</h1>
            <h3 class='displaySubTitle initial' v-bind:class="{ active: isActiveMid}" v-if='fail === 0'>
                But We'll need a password first</h3>
            <h1 class='displayTitle initial' v-bind:class="{ active: isActive}" v-if='fail === 2'>This
                tape has already been viewed</h1>
        </div>
        <transition-group name="left-alt">
        <div :key="1" class='entry' v-if='fail === 0'
            id='passEnter'>
            <transition name="error">
                <h1 class='displayTitle errorTitle' v-if="vFail == 1">Incorrect Password</h1>
                <h1 class='displayTitle errorTitle' v-if="vFail == 2">Decryption Failed</h1>
            </transition>

            <form @submit.prevent="verifyTape">
                <input v-model="pass" class='nameEntry' placeholder='Password' required><br>
                <input v-model="code1" class='nameEntry' placeholder='First Codeword' required><br>
                <input v-model="code2" class='nameEntry' placeholder='Second Codeword' required><br>
                <button type='submit'><i class="fas fa-step-forward"></i></button>
            </form>
        </div>

        <div :key="2" v-if='success === 1' id='tapeShow' class=''>
            <div v-if="step === 1">
                <h1>To: {{ rName }}</h1>
                <h2>The following message has been approved for your eyes only:</h2>
                <p>{{ tape }}</p>
                <h2>From: {{ yName }}</h2>
                <h2>This Message will self destruct in {{destruct}} seconds</h2>
            </div>
            <div v-if="step === 2">
                <h2>Message self destruct</h2>
            </div>
        </div>
    </transition-group>

</div>
<?php include 'bottom.php'?>