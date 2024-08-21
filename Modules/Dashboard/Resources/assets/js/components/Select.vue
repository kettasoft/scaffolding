<template>
    <div class="custom-select w-100" @click="toggleDropdown" ref="customSelect">
        <input v-if="useInputField" type="text" :value="selectedOption.id" :name="name" hidden :required="required">
        <div class="selected-option" :class="{
            'custom-select-opened': isDropdownVisible,
            'p-3': large
            }">
            <div class="data">
                <span class="select-placeholder" v-if="!selectedOption">{{
                    placeholder
                }}</span>
                <template v-else>
                    <img
                        v-if="selectedOption.image"
                        :src="selectedOption.image"
                        :alt="selectedOption.image"
                    />
                    <span>{{ selectedOption.text }}</span>
                </template>
            </div>
            <i class="fas fa-angle-down" :style="isDropdownVisible || 'transform: rotate(180deg)'"></i>
        </div>
        <div v-if="isDropdownVisible" class="dropdown">
            <input
                v-if="hasSearch"
                v-model="searchTerm"
                type="text"
                class="form-control"
                :placeholder="searchPlaceholder"
                @input="filterOptions"
                @click.stop
            />
            <vue-custom-scrollbar :settings="settings" tagname="ul" v-if="!fetchLoading">
                <li
                    v-for="(option, index) in filteredOptions"
                    :key="index"
                    @click="selectOption(option)"
                >
                    <img
                        v-if="option.image"
                        :src="option.image"
                        :alt="option.text"
                        width="20"
                        height="15"
                        class="me-3"
                    />
                    <span>{{ option.text }}</span>
                </li>
            </vue-custom-scrollbar>
            <div class="text-center my-2" v-else>
                <loading></loading>
            </div>
        </div>
    </div>
</template>

<script>
import vueCustomScrollbar from "vue-custom-scrollbar";
import Loading from '../Loading.vue';
export default {
    components: {
        vueCustomScrollbar,
        Loading,
    },

    props: {
        remote_url: {
            type: String,
            required: true,
        },
        placeholder: {
            required: false,
            default: "",
        },
        defaultValue: {
            required: false,
        },
        hasSearch: {
            type: Boolean,
            default: false,
        },
        searchPlaceholder: {
            type: String,
            default: "Search",
        },
        searchBy: {
            type: String,
            default: "text",
        },
        name: {
            type: String,
            required: false,
            default: ''
        },
        large: {
            type: Boolean,
            required: false,
            default: true
        },
        useCache: {
            required: false,
        },
        cacheExpiry: {
            type: Number,
            required: false,
            default: 5
        },
        useInputField: {
            type: Boolean,
            required: false,
            default: false,
        },
        required: {
            type: Boolean,
            required: false,
            default: false,
        }
    },
    data() {
        return {
            selectedOption: null,
            searchTerm: "",
            isDropdownVisible: false,
            fetchLoading: false,
            options: [],
            settings: {
                suppressScrollY: false,
                suppressScrollX: true,
                wheelPropagation: true,
            },
        };
    },

    mounted() {
        this.$nextTick(() => {
            this.setDefaultValue(this.defaultValue)
        })
        // if (this.defaultValue) {
        //     this.selectedOption = this.defaultValue;
        // }
        // this.initCache();
    },

    computed: {
        filteredOptions() {
            if (this.searchBy && this.hasSearch) {
                return this.options.filter((option) =>
                    option[this.searchBy]
                        .toLowerCase()
                        .includes(this.searchTerm.toLowerCase())
                );
            }

            return this.options;
        },

        cacheAllowed() {
            return Boolean(this.useCache)
        },
    },

    methods: {
        initCache() {
            // this.cacheExpirationChecker();
            // this.setOptionFromCache();
        },

        setDefaultValue() {
            if (this.defaultValue && !this.selectedOption) {
                this.selectOption(this.defaultValue);
            }
        },

        cacheExpirationChecker() {
            if (this.cacheExpiry) {
                const data = localStorage.getItem(this.useCache);

                if (!data || this.cacheExpiry == 0) {
                    return null
                }

                const item = JSON.parse(data);

                if (!(item instanceof Object) || item?.hasOwnProperty('expiry')) {
                    return null
                }

                const now = new Date();

                if (now.getTime() > item.expiry) {
                    // Data has expired, remove it from localStorage
                    window.localStorage.removeItem(this.useCache);
                    return null;
                }
            }
        },

        setOptionFromCache() {
            if (this.useCache) {
                const data = window.localStorage.getItem(this.useCache)

                if (data) {
                    this.selectOption(JSON.parse(data))
                }
            }
        },

        setOptionToCache(data) {
            if (this.useCache) {
                if (this.cacheExpiry) {
                    data = this.setCacheExpiry(data)
                }

                window.localStorage.setItem(this.useCache, JSON.stringify(data))
            }
        },

        setCacheExpiry(data) {
            const now = new Date;
            data = {...data, expiry: this.cacheExpiry + now.getItem() }

            return data;
        },

        toggleDropdown() {
            this.isDropdownVisible = !this.isDropdownVisible;
            if (this.isDropdownVisible) {
                // Add a click event listener to the document body
                document.body.addEventListener(
                    "click",
                    this.closeDropdownOnClickOutside
                );
            }
        },

        closeDropdownOnClickOutside(event) {
            // Check if the clicked element is outside the custom select component
            if (
                this.$refs.customSelect &&
                !this.$refs.customSelect.contains(event.target)
            ) {
                this.isDropdownVisible = false;
            }
        },
        filterOptions() {
            // Optionally perform additional filtering logic
        },
        selectOption(option) {
            if (option) {
                this.selectedOption = option;
                this.$emit('data', this.selectedOption)
                this.$emit("set", option.id);
            }
        },

        async fetch() {
            this.fetchLoading = true
            // Simulating an API call to fetch select options
            try {
                await axios.get(`${this.remote_url}`).then((response) => {
                    this.fetchLoading = false
                    this.options = response.data.data;
                });
                // Assuming the API returns an array of options with label and value properties
            } catch (error) {
                window.alert("Error fetching select options:", error);
            }
        },

        setCacheToLocalStorage(value) {
            if (this.useCache) {
                window.localStorage.setItem(this.useCache || this.name, JSON.stringify(value))
            }
        },

        selectOptionFromCache() {
            const data = window.localStorage.getItem(this.name)

            if (this.useCache && data) {
                this.selectOption(JSON.parse(data))
            }
        }
    },

    watch: {
        // selectedOption(value, old) {
            // this.setOptionToCache(value)
            // this.setCacheToLocalStorage(value);
        // },

        remote_url(value, old) {
            this.fetch()
            this.selectedOption = null
            console.log('Remote url')
            this.$emit("set", null);
        },

        isDropdownVisible(value, old) {
            if (!this.options.length && value) {
                this.fetch()
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.disabled {
    opacity: 0.5;
    cursor: no-drop;
}

.select-placeholder {
    color: #adb5bd;
}

.custom-select {
    position: relative;
    cursor: pointer;
}

img {
    width: 20px;
    height: 15px;
    margin-right: 1.5rem;
}

i {
    transition: all 0.3s;
}

.is-valid .selected-option {
    border-color: var(--bs-green);
}
.is-invalid .selected-option {
    border-color: var(--bs-danger);
}

.selected-option {
    display: flex;
    padding: 0.47rem 0.75rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    justify-content: space-between;
    align-items: center;

    &.custom-select-opened {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
}

.dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    border: 1px solid #ccc;
    border-top: 0;
    border-radius: 0 0 4px 4px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 1;
}

.dropdown input {
    width: -webkit-fill-available;
    padding: 8px;
    outline: none;
    margin: 8px;
}

.dropdown ul {
    max-height: 250px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.dropdown li {
    cursor: pointer;
    padding: 8px;
}

.dropdown li:hover {
    background-color: #f5f5f5;
}
</style>
