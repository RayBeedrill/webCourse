<template>
  <div class="day">
    <p>{{day['data']}}</p>
    <a  v-if="ev.roomId == idRoom && ev.year == year && ev.month == month && ev.start > nowDate" v-for="ev in dayProp" onclick="window.open(this.href, '', 'scrollbars=1,height='+Math.min(560, screen.availHeight)+',width='+Math.min(500, screen.availWidth)); return false;" :href="shopHome +'dateEdit/' + year + '/' + (month+1) + '/' + day['data'] + '/' + ev.id + '/'"><p>{{ev.start | dateFormat(timeF) }} - {{ev.end | dateFormat(timeF) }}</p></a>
    <p v-if="ev.roomId == idRoom && ev.year == year && ev.month == month && ev.start < nowDate" v-for="ev in dayProp">{{ev.start | dateFormat(timeF) }} - {{ev.end | dateFormat(timeF) }}</p>
  </div>
    
</template>

<script>
export default {
  name: 'day',
  data () {
    return {
      msg: 'day',
      eventsArr:[],
      dayArr:[], 
      dayProp:[],
      idRoom:'',
      timeF:'',
      timeStateStart:'',
      timeStateEnd:'',
      shopHome:shopHome,
      user:getCookie("id"),
      admin:'',
      nowDate:Date.now()
    }
  },
  props:['day','dayData','room','timeFormat','year','month','adminProp'],
  created(){
    this.getItemProps()
    this.idRoom = this.room
    this.timeF = this.timeFormat
    this.admin = this.adminProp
  },
  methods:{
    getItemProps(){
      this.dayProp = []
      for(let obj in this.dayData){
      if(this.dayData[obj].day == this.day['data']){
        
        this.dayProp.push(this.dayData[obj])  
      }
    }
  },
},
watch:{
    day(newDay){
      this.dayProp = []
      this.getItemProps()  
    },
    room(newRoom){
      this.idRoom = newRoom
      this.getItemProps()  
    },
    dayData(){
      this.getItemProps()
    },
    timeFormat(newTF){
      this.timeF = newTF
    }
  },
filters:{
  dateFormat(value, format){
    
    var eventStamp = value
    var date = new Date(eventStamp)
    var hours = date.getHours()
    var minutes = date.getMinutes()
    if(minutes < 10){
      minutes = '0' + minutes
    }
    if(format == '24h'){
      return hours + ' : ' + minutes
    }else{
      if(hours > 12){
        hours -= 12
        minutes  = minutes + ' p.m.'
      }else{
        minutes = minutes + ' a.m.'
      }

      return hours + ' : ' + minutes
    }
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

.title{
  text-align: center;
  margin-top: 15px;
}
.login-div{
  height: 180px;
  width: 100%;
  margin-top: 75px;
  padding: 15px 15px 0 15px;
  border-radius: 4px;
  -webkit-box-shadow: 0px 2px 13px 5px #B0B0B0;
  box-shadow: 0px 2px 13px 5px #B0B0B0;
}
.login-div form{
  text-align: center;
}

.login-div input{
  margin-top: 15px;
} 

.login-div button{
  margin-top: 15px;
}
</style>
