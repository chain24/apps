<template>
    <div id="login-modal" v-show="show" v-on:click="show = false">
        <div class="login-box">
            <a href="/auth/github" v-on:click.stop="">
                <div class="login-label">使用第三方服务登录</div>
                <img src="/storage/img/github-login.jpg"/>
            </a>
        </div>
    </div>
</template>

<script>
    import { EventBus } from '../../event-bus.js';
    export default {
        name: "loginModal",
        data() {
            return {
                show: false
            }
        },
        mounted() {
            EventBus.$on('prompt-login', function () {
                this.show = true;
            }.bind(this));
        }

    }
</script>

<style scoped>
    div#login-modal {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, .6)
    }

    div.login-box {
        max-width: 370px;
        min-width: 320px;
        padding: 0 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        -webkit-box-shadow: 0 1px 3px rgba(50, 50, 50, 0.08);
        box-shadow: 0 1px 3px rgba(50, 50, 50, 0.08);
        -webkit-border-radius: 4px;
        border-radius: 4px;
        font-size: 16px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%)
    }

    a {
        display: block;
        margin: auto;
        width: 230px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

</style>