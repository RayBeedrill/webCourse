<template>
  <div class="calend">
    <div class="container">
      <div class="row title">
        <div class="col-md-12">
          <div class="rooms-links">
            <p v-for="room in rooms" :class="selectedRoom == room.id_room ? 'btn-warning' : 'btn-primary' " class="btn btn-primary" v-on:click="getRoomEvents(room.id_room)">{{room.name}}</p>
          </div>
          <div class="calendar-nav">
            <button class="btn btn-primary" v-on:click="getPrevMonth"><</button>
            <div class="calendar-date">
              <h4>{{month}}</h4>
              <h5>{{year}}</h5>  
            </div>
            <button class="btn btn-primary" v-on:click="getNextMonth">></button>
          </div>
          <div class="text-left btn-group-calendar">
            <button class="btn btn-success" v-on:click="changeFormat">Format: {{format}}</button>
            <button class="btn btn-success" v-on:click="changeTimeFormat">Time Format: {{hourFormat}}</button>
          </div>
          <month 
          v-bind:monthArr="dayArr" 
          v-bind:format="format"
          v-bind:monthNumber="monthNum"
          v-bind:room="selectedRoom"
          v-bind:year="year"
          v-bind:hourF="hourFormat"
          ></month>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 text-left">
          <button class="btn btn-success" v-on:click="$router.push('/book/' + selectedRoom)">Book It!</button>
          <button v-if="admin" class="btn btn-warning" v-on:click="$router.push('/employeeList')">Employee List</button>
        </div>
        <div v-if="editMsg.length > 0" class="col-md-6 bg-info">
            <p class="text-danger" v-for="day in editMsg" v-if="typeMsg =='edit'">unsuccessfull update: {{day.start | dateFormat}} - {{day.end | dateFormat}}</p>
            <p class="text-success" v-for="day in editMsg" v-if="typeMsg =='del'">successfully deleted: {{day.start | dateFormat}} - {{day.end | dateFormat}}</p>
            <p></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Month from './Month'
export default {
  name: 'calend',
  data () {
    return {
      month:'',
      dayArr:[],
      year: new Date().getFullYear(),
      monthNum: new Date().getMonth(),
      format:'RU',
      hourFormat:'24h',
      admin:false,
      rooms:[],
      selectedRoom:'1',
      refresher:false,
      editMsg:[],
      typeMsg:''
    }
  },
  created:function(){
    this.getMonthArr(this.year, this.monthNum)
    this.checkAdmin()
    this.getRooms()
    window.getDelete = (bool,result,type) => {
      this.refresher = bool
      this.typeMsg = type
      if(result != null){
        if( result.length > 0){
          this.editMsg = []
          for(let day in result){
            this.editMsg.push(result[day])
          }
        }
      }
    }
  },
  components:{
    Month
  },
  methods: {
    getMonthArr(year, month, format = 'ru' ){
      let monthArr = ["January", "February", "March", "April", "May", "June", "Julay", "August", "September", "October", "November", "December"]
 
      this.dayArr = []
     var mon = month;
      var d = new Date(year, mon);
      
      this.month = monthArr[mon]
      var clearDay = 0 
      this.dayArr[0] = []

      for (var i = 0; i < this.getDay(d,format); i++) {
          this.dayArr[0].push({})
          clearDay ++
      }


      var row = 0
      while (d.getMonth() == mon) {
          this.dayArr[row].push({data: d.getDate()})

        if (this.getDay(d,format) % 7 == 6) { 
          row ++
          this.dayArr[row] = []
        }

        d.setDate(d.getDate() + 1);
      }
      return this.dayArr
      
    },
    getDay(date,format) { 
            var day = date.getDay();
            if(format == 'ru'){
              if (day == 0) day = 7;
              return day -1;
            }
            return day;
    },
    getNextMonth(){
      this.monthNum++
      if(this.monthNum > 11){
        this.monthNum = 0
        this.year++
      }
     this.dayArr = this.getMonthArr(this.year, this.monthNum)
    },
    getPrevMonth(){
      this.monthNum--
      if(this.monthNum < 0){
        this.monthNum = 11
        this.year--
      }
      this.dayArr = this.getMonthArr(this.year, this.monthNum)
    },
    changeFormat(){
      if(this.format == 'RU'){
        this.format = 'US'
        this.dayArr = this.getMonthArr(this.year, this.monthNum,'eng')
      }else{
        this.format = 'RU'
        this.dayArr = this.getMonthArr(this.year, this.monthNum,'ru')
      }
    },
    changeTimeFormat(){
      if(this.hourFormat == '24h'){
        this.hourFormat = '12h'
        
      }else{
        this.hourFormat = '24h'
      }
    },
    checkAdmin(){
      let adminCheck = (result) => {        
        if(result.id_role == "1"){
          this.admin = true
        }else{
          this.admin = false
        }
      }
     getQuery(this,myPath + 'application/api/auth/').then(adminCheck,null)
    },
    getRooms(){
      let roomData = (data) => {
        this.rooms = data
      }
      getQuery(this,myPath + 'application/api/rooms/').then(roomData,null)
    },
    getRoomEvents(id){
      this.selectedRoom = id
    }
  },
  watch: {
    '$route' (to, from) {
      this.checkAdmin()
    },
    selectedRoom(){
      this.getMonthArr(this.year, this.monthNum)
    },
    refresher(){
      this.getMonthArr(this.year, this.monthNum)
      this.refresher = false
    }
  },
  filters:{
  dateFormat(value){
    var time = value + '000'
    var eventStamp = Number(time)
    var date = new Date(eventStamp)
    var hours = date.getHours()
    var minutes = date.getMinutes()
    var day = date.getDate()
    var month = date.getMonth() + 1
    var year = date.getFullYear()
    if(minutes < 10){
      minutes = '0' + minutes
    }
    
      return hours + ' : ' + minutes + '   ' + day + '/' + month + '/' + year 
    
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

.btn-group-calendar{
  margin-bottom:15px; 
}

.calendar-nav button{
vertical-align: text-bottom;
margin:0 10px;
}

.calendar-nav .calendar-date{
  display: inline-block;
  width: 250px;
}
.rooms-links{
  margin-bottom:15px;
}
.rooms-links p{
  display: inline-block;
  margin: 0 10px;
}
</style>
