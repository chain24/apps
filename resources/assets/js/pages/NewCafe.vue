<template>
    <div class="page">
        <form>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="large-12 medium-12 small-12 cell">
                        <label>名称
                            <input type="text" placeholder="咖啡店名" v-model="name">
                        </label>
                        <span class="validation" v-show="!validations.name.is_valid">{{ validations.name.text }}</span>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>网址
                            <input type="text" placeholder="网址" v-model="website">
                        </label>
                        <span class="validation" v-show="!validations.website.is_valid">{{ validations.website.text }}</span>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>简介
                            <input type="text" placeholder="简介" v-model="description">
                        </label>
                    </div>
                </div>
                <div class="grid-x grid-padding-x" v-for="(location, key) in locations">
                    <div class="large-12 medium-12 small-12 cell">
                        <h3>位置</h3>
                    </div>
                    <div class="large-6 medium-6 small-12 cell">
                        <label>位置名称
                            <input type="text" placeholder="位置名称" v-model="locations[key].name">
                        </label>
                    </div>
                    <div class="large-6 medium-6 small-12 cell">
                        <label>详细地址
                            <input type="text" placeholder="详细地址" v-model="locations[key].address">
                        </label>
                        <span class="validation" v-show="!validations.locations[key].address.is_valid">{{ validations.locations[key].address.text }}</span>
                    </div>
                    <div class="large-6 medium-6 small-12 cell">
                        <label>城市
                            <input type="text" placeholder="城市" v-model="locations[key].city">
                        </label>
                        <span class="validation" v-show="!validations.locations[key].city.is_valid">{{ validations.locations[key].city.text }}</span>
                    </div>
                    <div class="large-6 medium-6 small-12 cell">
                        <label>省份
                            <input type="text" placeholder="省份" v-model="locations[key].state">
                        </label>
                        <span class="validation" v-show="!validations.locations[key].state.is_valid">{{ validations.locations[key].state.text }}</span>
                    </div>
                    <div class="large-6 medium-6 small-12 cell">
                        <label>邮编
                            <input type="text" placeholder="邮编" v-model="locations[key].zip">
                        </label>
                        <span class="validation" v-show="!validations.locations[key].zip.is_valid">{{ validations.locations[key].zip.text }}</span>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <label>支持的冲泡方法</label>
                        <span class="brew-method" v-for="brewMethod in brewMethods">
                        <input v-bind:id="'brew-method-'+brewMethod.id+'-'+key" type="checkbox"
                               v-bind:value="brewMethod.id"
                               v-model="locations[key].methodsAvailable">
                        <label v-bind:for="'brew-method-'+brewMethod.id+'-'+key">{{ brewMethod.method }}</label>
                    </span>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <tags-input v-bind:unique="key"></tags-input>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <a class="button" v-on:click="removeLocation(key)">移除位置</a>
                    </div>
                </div>
                <div class="grid-x grid-padding-x">
                    <div class="large-12 medium-12 small-12 cell">
                        <a class="button" v-on:click="addLocation()">新增位置</a>
                    </div>
                    <div class="large-12 medium-12 small-12 cell">
                        <a class="button" v-on:click="submitNewCafe()">提交表单</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {TagsInput} from '../components/global/forms/TagsInput';
    import {EventBus} from '../event-bus.js';
    import {ROAST_CONFIG} from '../config.js';
    export default {
        components: {
            TagsInput
        },
        data() {
            return {
                name: '',
                locations: [],
                website: '',
                description: '',
                roaster: false,
                validations: {
                    name: {
                        is_valid: true,
                        text: ''
                    },
                    locations: [],
                    oneLocation: {
                        is_valid: true,
                        text: ''
                    },
                    website: {
                        is_valid: true,
                        text: ''
                    }
                }
            }
        },
        methods: {
            submitNewCafe: function () {
                if (this.validateNewCafe()) {
                    this.$store.dispatch('addCafe', {
                        name: this.name,
                        locations: this.locations,
                        website: this.website,
                        description: this.description,
                        roaster: this.roaster
                    })
                }
            },
            validateNewCafe: function () {
                let validNewCafeForm = true;
                for (var index in this.locations) {
                    if (this.locations.hasOwnProperty(index)) {
                        // 确保地址字段不为空
                        if (this.locations[index].address.trim() === '') {
                            validNewCafeForm = false;
                            this.validations.locations[index].address.is_valid = false;
                            this.validations.locations[index].address.text = 'Please enter an address for the new cafe!';
                        } else {
                            this.validations.locations[index].address.is_valid = true;
                            this.validations.locations[index].address.text = '';
                        }
                        // 确保城市字段不为空
                        if (this.locations[index].city.trim() === '') {
                            validNewCafeForm = false;
                            this.validations.locations[index].city.is_valid = false;
                            this.validations.locations[index].city.text = 'Please enter a city for the new cafe!';
                        } else {
                            this.validations.locations[index].city.is_valid = true;
                            this.validations.locations[index].city.text = '';
                        }

                        // 确保省份字段不为空
                        if (this.locations[index].state.trim() === '') {
                            validNewCafeForm = false;
                            this.validations.locations[index].state.is_valid = false;
                            this.validations.locations[index].state.text = 'Please enter a state for the new cafe!';
                        } else {
                            this.validations.locations[index].state.is_valid = true;
                            this.validations.locations[index].state.text = '';
                        }

                        // 确保邮编字段不为空
                        if (this.locations[index].zip.trim() === '' || !this.locations[index].zip.match(/(^\d{6}$)/)) {
                            validNewCafeForm = false;
                            this.validations.locations[index].zip.is_valid = false;
                            this.validations.locations[index].zip.text = 'Please enter a valid zip code for the new cafe!';
                        } else {
                            this.validations.locations[index].zip.is_valid = true;
                            this.validations.locations[index].zip.text = '';
                        }
                        // 确保网址是有效的 URL
                        if (this.website.trim !== '' && !this.website.match(/^((https?):\/\/)?([w|W]{3}\.)+[a-zA-Z0-9\-\.]{3,}\.[a-zA-Z]{2,}(\.[a-zA-Z]{2,})?$/)) {
                            validNewCafeForm = false;
                            this.validations.website.is_valid = false;
                            this.validations.website.text = '请输入有效的网址 URL';
                        } else {
                            this.validations.website.is_valid = true;
                            this.validations.website.text = '';
                        }
                    }

                }
            },
            addLocation() {
                this.locations.push({name: '', address: '', city: '', state: '', zip: '', methodsAvailable: [], tags: ''});
                this.validations.locations.push({
                    address: {
                        is_valid: true,
                        text: ''
                    },
                    city: {
                        is_valid: true,
                        text: ''
                    },
                    state: {
                        is_valid: true,
                        text: ''
                    },
                    zip: {
                        is_valid: true,
                        text: ''
                    }
                });
            },
            clearForm() {
                this.name = '';
                this.locations = [];
                this.website = '';
                this.description = '';
                this.roaster = false;
                this.validations = {
                    name: {
                        is_valid: true,
                        text: ''
                    },
                    locations: [],
                    oneLocation: {
                        is_valid: true,
                        text: ''
                    },
                    website: {
                        is_valid: true,
                        text: ''
                    }
                };

                this.addLocation();
            }
        },
        created(){
            this.addLocation();
        },
        computed: {
            brewMethods() {
                return this.$store.getters.getBrewMethods;
            },
            addCafeStatus() {
                return this.$store.getters.getCafeAddStatus;
            }
        },
        mounted() {
            EventBus.$on('tags-edited', function (tagsAdded) {
                this.locations[tagsAdded.unique].tags = tagsAdded.tags;
            }.bind(this));
        },
        watch: {
            'addCafeStatus': function () {
                if (this.addCafeStatus === 2) {
                    // 添加成功
                    this.clearForm();
                    $("#cafe-added-successfully").show().delay(5000).fadeOut();
                }

                if (this.addCafeStatus === 3) {
                    // 添加失败
                    $("#cafe-added-unsuccessfully").show().delay(5000).fadeOut();
                }
            }
        },
    }
</script>

<style scoped lang="scss">
    @import '~@/abstracts/_variables.scss';
    div#new-cafe-page {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: white;
        z-index: 99999;
        overflow: auto;
        img#back {
            float: right;
            margin-top: 20px;
            margin-right: 20px;
        }
        .centered {
            margin: auto;
        }
        h2.page-title {
            color: #342C0C;
            font-size: 36px;
            font-weight: 900;
            font-family: "Lato", sans-serif;
            margin-top: 60px;
        }
        label.form-label {
            font-family: "Lato", sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            color: black;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        input[type="text"].form-input {
            border: 1px solid #BABABA;
            border-radius: 3px;
            &.invalid {
                border: 1px solid #D0021B;
            }
        }
        div.validation {
            color: #D0021B;
            font-family: "Lato", sans-serif;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 15px;
        }
        div.location-type {
            text-align: center;
            font-family: "Lato", sans-serif;
            font-size: 16px;
            width: 25%;
            display: inline-block;
            height: 55px;
            line-height: 55px;
            cursor: pointer;
            margin-bottom: 5px;
            margin-right: 10px;
            background-color: #EEE;
            color: $black;
            &.active {
                color: white;
                background-color: $secondary-color;
            }
            &.roaster {
                border-top-left-radius: 3px;
                border-bottom-left-radius: 3px;
                border-right: 0px;
            }
            &.cafe {
                border-top-right-radius: 3px;
                border-bottom-right-radius: 3px;
            }
        }
        div.company-selection-container {
            position: relative;
            div.company-autocomplete-container {
                border-radius: 3px;
                border: 1px solid #BABABA;
                background-color: white;
                margin-top: -17px;
                width: 80%;
                position: absolute;
                z-index: 9999;
                div.company-autocomplete {
                    cursor: pointer;
                    padding-left: 12px;
                    padding-right: 12px;
                    padding-top: 8px;
                    padding-bottom: 8px;
                    span.company-name {
                        display: block;
                        color: #0D223F;
                        font-size: 16px;
                        font-family: "Lato", sans-serif;
                        font-weight: bold;
                    }
                    span.company-locations {
                        display: block;
                        font-size: 14px;
                        color: #676767;
                        font-family: "Lato", sans-serif;
                    }
                    &:hover {
                        background-color: #F2F2F2;
                    }
                }
                div.new-company {
                    cursor: pointer;
                    padding-left: 12px;
                    padding-right: 12px;
                    padding-top: 8px;
                    padding-bottom: 8px;
                    font-family: "Lato", sans-serif;
                    color: #054E7A;
                    font-style: italic;
                    &:hover {
                        background-color: #F2F2F2;
                    }
                }
            }
        }
        a.add-location-button {
            display: block;
            text-align: center;
            height: 50px;
            color: white;
            border-radius: 3px;
            font-size: 18px;
            font-family: "Lato", sans-serif;
            background-color: #A7BE4D;
            line-height: 50px;
            margin-bottom: 50px;
        }
    }
    /* Small only */
    @media screen and (max-width: 39.9375em) {
        div#new-cafe-page {
            div.location-type {
                width: 50%;
            }
        }
    }
</style>