<template>
<router-view v-if="$route.matched.length"></router-view>
<div v-else class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</template>