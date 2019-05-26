<?php include 'top.php'?>
<div id="app">
    <h1 class='homeTitle initial' v-bind:class="{ active: isActive}">Tape Agent</h1>
    <div v-cloak id='input' class='initial' v-bind:class="{ active: isActiveMid}">
        <transition-group :name="transitionName">
            <div v-on:click="changeStep('next')" class="cassette" :key="1" v-if='step === 0'>
                <div class="innerbox">
                    <div class="label">
                        <span>click me<span>
                    </div>
                    <div class="spin1">
                    </div>
                    <div class="spin2">
                    </div>
                </div>
            </div>
            <div class='entry' :key="2" v-if='step === 1'>
                <h2>How many people should access this message?</h2>
                <form @submit.prevent="changeStep('next')">
                    <input type='number' min='1' max='10' class='nameEntry numEntry' maxlength="50" v-model="many"
                        required><br>
                    <h2>And how seconds should it show for?</h2>
                    <input type='number' min='1' max='20' class='nameEntry numEntry' maxlength="50" v-model="timer"
                        required><br>
                    <button type='submit'><i class="fas fa-step-forward"></i></button>
                </form>
            </div>

            <div class='entry' :key="3" v-if='step === 2'>
                <h2>What are they called?</h2>
                <form @submit.prevent="changeStep('next')">
                    <input class='nameEntry' maxlength="50" v-model="rName" placeholder='Their Name(s)' required><br>
                    <button type="button" v-on:click="changeStep('prev')"><i class="fas fa-step-backward"></i></button>
                    <button type='submit'><i class="fas fa-step-forward"></i></button>
                </form>
            </div>

            <div class='entry' :key="4" v-if='step === 3'>
                <h2>Your Message?</h2>
                <form @submit.prevent="changeStep('next')">
                    <textarea class='textEntry' maxlength="918" v-model="tape" placeholder='Message'
                        required></textarea><br>
                    <button type="button" v-on:click="changeStep('prev')"><i class="fas fa-step-backward"></i></button>
                    <button type='submit'><i class="fas fa-step-forward"></i></button>
                </form>
            </div>

            <div class='entry' :key="5" v-if='step === 4'>
                <h2>Your Name?</h2>
                <form @submit.prevent="changeStep('next')">
                    <input class='nameEntry' v-model="yName" maxlength="50" placeholder='Your Name' required><br>
                    <button type="button" v-on:click="changeStep('prev')"><i class="fas fa-step-backward"></i></button>
                    <button type='submit'><i class="fas fa-step-forward"></i></button>
                </form>
            </div>

            <div class='entry' :key="6" v-if='step === 5'>
                <form @submit.prevent="changeStep('next')">
                    <h2>Password?</h2>
                    <input type='text' v-model="pass" placeholder='Password' required><br>
                    <button type="button" v-on:click="changeStep('prev')"><i class="fas fa-step-backward"></i></button>
                    <button type='submit'><i class="fas fa-step-forward"></i></button>
                </form>
            </div>

            <div class='entry' :key="7" v-if='step === 6'>
                <form @submit.prevent="submit">
                    <h2>Codewords?</h2>
                    <input type='text' v-model="code1" placeholder='First Codeword' required><br>
                    <input type='text' v-model="code2" placeholder='Second Codeword' required><br>
                    <button type="button" v-on:click="changeStep('prev')"><i class="fas fa-step-backward"></i></button>
                    <button type='submit'><i class="fas fa-stop"></i></button>
                </form>
            </div>

            <div id='letter' :key="8" v-if='step === 7'>
                <h2>Your link:</h2><span>tapeagent.app/{{ link }}</span>
                <h2>Your password:</h2><span>{{ pass }}</span>
                <h2>Your First Codeword:</h2><span>{{ code1 }}</span>
                <h2>Your Second Codeword:</h2><span>{{ code2 }}</span>
            </div>

        </transition-group>
    </div>
    <div class='initial' v-bind:class="{ active: isActiveLast}">
        <transition name="fade">
            <ul v-if="step === 0" class='footer'>
                <li><i class="fab fa-vuejs"></i></li>
                <li><i class="fab fa-sass"></i></li>
                <li><i class="fab fa-php"></i></li>
                <li><a href='https://github.com/SFidan/tape-agent'><i class="fab fa-github"></i></a></li>
                <ul>
        </transition>
    </div>
</div>
<?php include 'bottom.php'?>