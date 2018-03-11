<template>
  <div class="profile">
    <h3>{{ msg }}</h3>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'Profile',
  data () {
    return {
      msg: 'profile'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
