<template>
  <select v-on:change="sendId" v-model="selectOption">
      <option value="0">dissabled</option>
      <option value="1">active</option>
  </select>
</template>

<script>
export default {
  name: 'EditUsers',
  data () {
    return {
      selectOption:this.valueSel,
      userid:this.user
    }
  },
  props:['user','valueSel'],
  methods:{
    sendId(){
      let data ={
        'status' : this.selectOption,
        'id_user' : this.userid
      }
      
      this.$emit('sendId',data)
    }
  }
}
</script>

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
select{
  moz-appearance: initial;
  -webkit-appearance: menulist;
}
</style>
