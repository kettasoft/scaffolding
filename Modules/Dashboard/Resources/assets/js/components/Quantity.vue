<template>
    <div class="quantity-body" :class="{ disabled: disabled }" ref="quantity">
        <div class="quantity-input-box gap-2">
            <div class="input-arrows">
                <span @click="decrement">-</span>
            </div>
            <input
                type="number"
                v-model.number="quantity"
                @input="onInput"
                class="form-control quantity-input"
                :disabled="disabled"
            />
            <div class="input-arrows">
                <span @click="increment">+</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    activated() {},
    props: {
        index: {
            require: false,
            default: null,
        },
        default: {
            type: Number,
            require: false,
            default: 1,
        },
        maxCount: {
            require: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            quantity: this.default == null ? 1 : this.default,
            max: 1000,
        };
    },
    methods: {
        increment() {
            if (!this.disabled) {
                if (this.quantity >= this.max) {
                    this.fireAnimationError();
                } else {
                    this.$emit(
                        "updateQuantity",
                        (this.quantity = this.quantity + 1),
                        this.index
                    );
                    this.$forceUpdate();
                }
            }
        },
        decrement() {
            if (!this.disabled) {
                if (this.quantity > 1) {
                    this.$emit(
                        "updateQuantity",
                        (this.quantity = this.quantity - 1),
                        this.index
                    );
                    this.$forceUpdate();
                }
            }
        },
        onInput() {
            if (this.quantity == 0) {
                this.quantity = 1;
            }
            if (this.quantity > this.max) {
                this.quantity = this.max;
                this.fireAnimationError();
            } else {
                this.$emit("updateQuantity", this.quantity, this.index);
            }
        },

        fireAnimationError() {
            this.$refs.quantity.classList.add("zigzag-box");

            setTimeout(() => {
                this.$refs.quantity.classList.remove("zigzag-box");
            }, 300);
        },

        defineMaxCount() {
            this.max = this.maxCount;
            return;
        },
    },
    mounted() {
        this.defineMaxCount();
    },
};
</script>

<style lang="scss" scoped>

.quantity-body.disabled {
    .quantity-input-box .input-arrows span {
        background: var(--bs-gray-600);
        cursor: no-drop;
    }
}
.quantity-input {
    width: 100%;
    border-radius: 11px;
    padding-right: 0;
    padding-left: 0;
    text-align: center;
    -moz-appearance: textfield; /* Firefox */
    &::-webkit-outer-spin-button,
    &::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
}

.quantity-input::-webkit-inner-spin-button,
.quantity-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    appearance: none;
    margin: 0;
}

html[dir="rtl"] {
    .quantity-input-box {
        flex-direction: row-reverse;
    }
}

.quantity-input-box {
    display: flex;
}

.quantity-input-box .input-arrows {
    display: flex;
    align-items: center;
    gap: 20px;
    justify-content: center;
    height: auto;
    width: 21px;
}

.quantity-input-box .input-arrows span {
    width: inherit;
    background-color: #E4E6EF;
    display: block;
    border-radius: 0 0.25rem 0 0;
    border: 1px solid #F1FAFF;
    color: var(--bs-primary);
    text-align: center;
    font-family: "Be Vietnam Pro";
    font-size: 13px;
    font-style: normal;
    font-weight: 400;
    cursor: pointer;
    user-select: none;
    transition: all 0.3s;

    &:hover {
        background-color: var(--bs-primary);
        color: var(--bs-white)
    }
}

.quantity-input-box .input-arrows span:last-child {
    height: 100%;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
}

@keyframes zigzag {
    0% {
        transform: translateX(0);
    }
    25% {
        transform: translateX(3px);
    }
    50% {
        transform: translateX(0);
    }
    75% {
        transform: translateX(-3px);
    }
    100% {
        transform: translateX(0);
    }
}

.zigzag-box {
    animation: zigzag 0.2s linear infinite;
}
</style>
