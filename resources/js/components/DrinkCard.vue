<template>
    <div class="p-3 col-xs-12 col-sm-9 col-md-6 col-lg-4">
        <div class="card shadow-lg">
            <img :src="drink.image" class="card-img-top p-1 drink-image" :alt="drink.name">
            <div class="card-body">
                <h5 class="card-title" v-text="drink.name"></h5>
                <p class="card-text pb-3" v-text="drink.description"></p>
                <div class="row">
                    <div class="offset-2 col-8 justift-content-center">
                        <label>Quantity Consumed Today:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary btn-add-drink" type="button" @click="removeDrink(drink)" :disabled="drinks_consumed[drink.id] <= 0">-</button>
                            </div>
                            <input type="number" class="form-control" min="0" :value="drinks_consumed[drink.id]" style="text-align: center;" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary btn-remove-drink" type="button" @click="addDrink(drink)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="text-center text-sm">
                    <span><small>You can safely consume</small> <span class="font-weight-bold" v-text="num_can_safely_consume"></span> <small>more of these</small></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'Drinks',
        props: [ 
            'drink', 
            'caffeine_consumed', 
            'safe_caffeine_limit',
            'drinks_consumed'
        ],

        data() {
            return {
                num_can_safely_consume: 0
            }
        },

        mounted() {
            this.calcSafeConsumeNum(this.caffeine_consumed)
            this.drinks_consumed[this.drink.id] = this.drinks_consumed.hasOwnProperty(this.drink.id) ? this.drinks_consumed[this.drink.id] : 0
        },

        watch: {

            caffeine_consumed: {
                deep: true,
                handler: function(new_caffeine_consumed_value) {
                    this.calcSafeConsumeNum(new_caffeine_consumed_value)
                }
            }

        },

        methods: {
            addDrink: function (drink) {
                this.drinks_consumed[this.drink.id]++
                this.$emit('addDrink', drink);
            },

            removeDrink: function (drink) {
                if(this.drinks_consumed[this.drink.id] > 0) {
                    this.drinks_consumed[this.drink.id]--
                }
                this.$emit('removeDrink', drink);
            },

            calcSafeConsumeNum: function (caffeine_consumed = 0) {
                if(caffeine_consumed == 0) {
                    this.num_can_safely_consume = this.drink.caffeine_content > 0 ? Math.floor( this.safe_caffeine_limit / this.drink.caffeine_content ) : 0
                } else {
                    if(this.drink.caffeine_content > 0) {
                        let updated_safe_consume_amt = Math.floor( (this.safe_caffeine_limit - caffeine_consumed) / this.drink.caffeine_content )
                        this.num_can_safely_consume = updated_safe_consume_amt <= 0 ? 0 : updated_safe_consume_amt
                    }
                }
            }
        }
    }
</script>