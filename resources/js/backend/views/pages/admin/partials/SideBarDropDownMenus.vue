<template>
    <li :class="`mm-collapse ${is_show && 'mm-active'}`">
        <a class="has-arrow" href="#">
            <div class="parent-icon">
                <!-- <i :class="icon"></i> -->
                <img :src="icon_image" alt="">
            </div>
            <div class="menu-title">{{ menu_title }}</div>
        </a>
        <ul :class="`mm-collapse ${is_show && 'mm-show'}`">
            <li v-for="(menu, index) in menus" :key="index" >
                <router-link :to="{name: menu.route_name}">
                    <i class="zmdi zmdi-dot-circle-alt"></i>
                    {{ menu.title }}
                </router-link>
            </li>
        </ul>
    </li>
</template>

<script>
export default {
    props: {
        menu_title: String,
        menus: Array,
        icon_image: String,
        icon: {
            type: String,
            default: ()=> "zmdi zmdi-dashboard",
        }
    },
    data: () => ({
        is_show: 0,
    }),
    methods: {
        toggle_menu: function(){
            this.is_show = !this.is_show
        }
    }
}
</script>

<style></style>
