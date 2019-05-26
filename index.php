<?php include 'top.php'?>
<div id="app">
    <h1 class='homeTitle'>Tape Agent</h1>
    <div id='input'>
        <transition-group :name="transitionName">
            <div class='entry' :key="0" v-if='step === 0'>
                <form @submit.prevent="changeStep('next')">
                    <button type='submit'><i class="fas fa-play"></i></button>
                </form>
            </div>

            <div class='entry' :key="1" v-if='step === 1'>
                <form @submit.prevent="changeStep('next')">
                    <input class='nameEntry' maxlength="50" v-model="rName" placeholder='Their name' required><br>
                    <button type='submit'><i class="fas fa-step-forward"></i></button>
                </form>
            </div>

            <div class='entry' :key="2" v-if='step === 2'>
                <form @submit.prevent="changeStep('next')">
                    <textarea class='textEntry' maxlength="918" v-model="tape" placeholder='Your Tape' required></textarea><br>
                    <button type="button" v-on:click="changeStep('prev')"><i class="fas fa-step-backward"></i></button>
                    <button type='submit'><i class="fas fa-step-forward"></i></button>
                </form>
            </div>

            <div class='entry' :key="3" v-if='step === 3'>
                <form @submit.prevent="changeStep('next')">
                    <input class='nameEntry' v-model="yName" maxlength="50" placeholder='Your name' required><br>
                    <button type="button" v-on:click="changeStep('prev')"><i class="fas fa-step-backward"></i></button>
                    <button type='submit'><i class="fas fa-step-forward"></i></button>
                </form>
            </div>

            <div class='entry' :key="4" v-if='step === 4'>
                <form @submit.prevent="submit">
                    <input type='text' v-model="pass" placeholder='Password' required><br>
                    <button type="button" v-on:click="changeStep('prev')"><i class="fas fa-step-backward"></i></button>
                    <button type='submit'><i class="fas fa-stop"></i></button>
                </form>
            </div>

            <div id='letter' :key="5" v-if='step === 5'>
                <h2>Your link:</h2><br><span>tapeagent.app/{{ link }}</span>
                <h2>Your password:</h2><br><span>{{ pass }}</span>
            </div>

        </transition-group>
    </div>
</div>
<ul class='footer'>
<li><i class="fab fa-vuejs"></i></li>
<li><i class="fab fa-sass"></i></li>
<li><i class="fab fa-php"></i></li>
<li><a href='https://github.com/SFidan/tape-agent'><i class="fab fa-github"></i></a></li>
<ul>
<?php include 'bottom.php'?>