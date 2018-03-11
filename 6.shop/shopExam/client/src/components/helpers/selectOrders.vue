<template>
  <div>
  <select v-on:change="sendIdOrder" v-model="selectOption">
      <option v-for="obj in this.orderArr" :value="obj.id_status">{{obj.name}}</option>
  </select>
  <p>{{err}}</p>
  </div>
</template>

<script>
export default {
  name: 'SelectOrders',
  data () {
    return {
      selectOption:'',
      orderId:this.order,
      err:''
    }
  },
  created:function(){
    this.setStatus()
  },
  props:['order','valueSel','orderArr'],
  methods:{
    sendIdOrder(){
      let data ={
        'status' : this.selectOption,
        'id' : this.orderId
      }
      this.err = 'status changed'
      this.$emit('sendIdOrder',data)
    },
    setStatus(){
      let arr = this.orderArr
      for(let obj in arr){
        if(arr[obj].name == this.valueSel){
          this.selectOption = arr[obj].id_status
        }
      }
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
