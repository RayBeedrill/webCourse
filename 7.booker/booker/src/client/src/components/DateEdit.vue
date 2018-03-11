<template>
  <div class="container">
    <div class="row">
      <h3>Event for:{{room}}</h3>
      <div class="col-md-4 col-md-offset-4">
        <div class="col-md-12">
          <p class="text-left">1. Booked for:</p>
          <select v-if="admin" v-model="user" class="form-control">
            <option :value="user.id_user" v-for="user in usersArr">{{user.name}}</option>
          </select>
          <p class="text-left" v-if="!admin && userObj.id_user == user" v-for="userObj in usersArr">{{userObj.name}}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="col-md-12"><p class="text-left">2. Specify what the time and end of the meeting(This will be what people see on the calendar.)</p></div>
        <div class="col-md-12" v-if="timeStartMsg"><p class="text-left text-danger">{{timeStartMsg}}</p></div>
        <div class="col-md-12" v-if="timeEndMsg"><p class="text-left text-danger">{{timeEndMsg}}</p></div>
        <div class="col-md-4 col-sm-4 marg col-xs-4">
          <select v-if="admin || userId == user"  v-model="timeStartHour" class="form-control">
            <option :value="hour"  v-for="hour in 12">{{hour}}</option>
          </select>
          <p v-if="!admin && userId != user">{{timeStartHour}}</p>
        </div>
        <div class="col-md-4 col-sm-4 marg col-xs-4">
          <select v-if="admin || userId == user" v-model="timeStartMin" class="form-control">
            <option value="0" >0</option>
            <option :value="minute * 15" v-for="minute in 3">{{minute * 15}}</option>
          </select>
          <p v-if="!admin && userId != user">{{timeStartMin}}</p>
        </div>
        <div class="col-md-4 col-sm-4 marg col-xs-4">
          <select v-if="admin || userId == user" v-model="timeStartMidnight"  class="form-control">
            <option value="0">AM</option>
            <option value="1">PM</option>
          </select>
           <p v-if="!admin && userId != user && timeStartMidnight == 0">AM</p>
           <p v-if="!admin && userId != user && timeStartMidnight == 1">PM</p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4">
          <select v-if="admin || userId == user"  v-model="timeEndHour" class="form-control">
            <option :value="hour"  v-for="hour in 12">{{hour}}</option>
          </select>
          <p v-if="!admin && userId != user">{{timeEndHour}}</p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4">
          <select v-if="admin || userId == user" v-model="timeEndMin" class="form-control">
            <option value="0" >0</option>
            <option :value="minute * 15" v-for="minute in 3">{{minute * 15}}</option>
          </select>
          <p v-if="!admin && userId != user">{{timeEndMin}}</p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4">
          <select v-if="admin || userId == user" v-model="timeEndMidnight"  class="form-control">
            <option value="0">AM</option>
            <option value="1">PM</option>
          </select>
          <p v-if="!admin && userId != user && timeEndMidnight == 0">AM</p>
           <p v-if="!admin && userId != user && timeEndMidnight == 1">PM</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="col-md-12">
          <p class="text-left">3. The specifics for the meetings:</p>
          <p>{{desc}}</p>
        </div>
      </div>
    </div>
    <div class="row" v-if="admin && recurringCheck || userId == user && recurringCheck">
      <div class="col-md-4 col-md-offset-4">
        <div class="col-md-12">
          <div class="checkbox">
            <label class="pull-left">
              <input  v-model="recurring" type="checkbox"> 4. Apply to all occurrences?
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="col-md-12">
          <p class="pull-left">Submitted:{{dayCreate}}</p>
        </div>
      </div>
    </div>
    <div class="row" v-if="admin || userId == user">
      <div class="col-md-4 col-md-offset-4">
        <button v-on:click="editBookRoom" type="button" class="btn btn-success">Update</button>
        <button v-on:click="deleteBooking" type="button" class="btn btn-danger">Delete</button>
     </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'dateEdit',
  data () {
    return {
    msg:'book',
    room:'',
    roomId:'',
    usersArr:[],
    user:'',
    yearsArr: ['2017','2018','2019'],
    monthArr: [
      "January", 
      "February", 
      "March", 
      "April", 
      "May", 
      "June", 
      "Julay", 
      "August", 
      "September", 
      "October", 
      "November", 
      "December"
    ],
    days:[],
    month:0,
    year:0,
    day:0,
    dayCreate:'',
    timeStartHour:1,
    timeEndHour:1,
    timeStartMin:0,
    timeEndMin:0,
    timeStartMidnight:0,
    timeEndMidnight:0,
    recurring:false,
    recurringCheck:false,
    recurringType:1,
    recurringDuration:'',
    desc:'',
    admin:false,
    userId:getCookie("id"),
    timeStartMsg:'',
    timeEndMsg:'',
    }
  },
  created(){
    this.checkAdmin()
    this.getUsers()
    this.setDateSelect()
    this.getEventData()
  },
  methods: {
    formCheck(){
      this.timeStartMsg = ''
      this.timeEndMsg = ''
  
      let hourValidate = (hour,dayPosition) => {
        if(dayPosition == "0"){
          if(hour >= 8){
            return true
          }else{
            return false            
          }
        }else{
          if(hour <= 8){
            return true
          }else{
            return false            
          }
        }
      } 
      var hourS = hourValidate(this.timeStartHour,this.timeStartMidnight)
      var hourE = hourValidate(this.timeEndHour,this.timeEndMidnight)
      
      if(this.timeStartHour == this.timeEndHour && this.timeStartMin == this.timeEndMin && this.timeStartMidnight == this.timeEndMidnight){
        
       
      this.timeStartMsg = 'start and end of meeting cant bee equivalent'
          this.timeEndMsg = ''
          var hourEqv = false  
      }else{
        var hourEqv = true     
      }

      if(hourS){
        hourS = true
      }else{
        this.timeStartMsg = 'rooms are availiable from 8 a.m. to 8 p.m, wrong start value'
        hourS = false
      }
      
      if(hourE){
        hourE = true
      }else{
        this.timeEndMsg = 'rooms are availiable from 8 a.m. to 8 p.m, wrong end value'
        hourE = false
      }

      if( hourS && hourE && hourEqv){
        return true
      }else{
        return false
      }
    
    },
    getEventData(){
      let id = this.$route.params.id

      let setEventData = (result) =>{
        let day = result[0]
        this.roomId = day.roomId
        this.user = day.user
        this.desc = day.desc
        if(day.recurring == '1'){
          this.recurringCheck = true  
        }
        
        let stampStart = new Date()
        let stampEnd = new Date()
        let stampCreate = new Date()
        day.startEvent += '000'
        day.endEvent += '000'
        day.dayCreation += '000'
        stampStart.setTime(Number(day.startEvent))
        stampEnd.setTime(Number(day.endEvent))
        stampCreate.setTime(Number(day.dayCreation))
        this.month = stampStart.getMonth()
        
        this.day = stampStart.getDate() - 1

        this.dayCreate = stampCreate.toDateString()
        
        let hourStart = stampStart.getHours()
        if(hourStart > 12){
          hourStart = hourStart - 12
          this.timeStartMidnight = 1
        }else{
          this.timeStartMidnight = 0
        }
        this.timeStartHour = hourStart

        let hourEnd = stampEnd.getHours()
        if(hourEnd > 12){
          hourEnd = hourEnd - 12
          this.timeEndMidnight = 1
        }else{
          this.timeEndMidnight = 0
        }
        this.timeEndHour = hourEnd

        let yearEv = stampStart.getFullYear()
        for(let year in  this.yearsArr){
          if(this.yearsArr[year] == yearEv){
            this.year = year
          }
        }

        this.timeStartMin  = stampStart.getMinutes()     
        this.timeEndMin  = stampEnd.getMinutes()     
      }

      getQuery(this,myPath + 'application/api/events/' + id).then(setEventData,null)
    },
    deleteBooking(){
      
      
      let data = this.$route.params.id + '/' + this.recurring  
      
      
      let deleteData = (result) => {
        
        window.opener.getDelete(true,result,'del')
        
        window.close()
      }
      if(confirm("Are you sure?")){
        deleteQuery(this,myPath + 'application/api/events/',data).then(deleteData,null)  
      }
      
    },
    setDateSelect(month=false){
      let date = new Date
      if(month){
        var mon = month + 1 
      }else{
        var mon = date.getMonth() + 1 
      }
      this.days = []
      let col = new Date(date.getFullYear(),mon , 0).getDate()
      for(let i = 1; i <= col; i++){
        this.days.push(i)
      }
    },
    getRooms(){
      let roomData = (data) => {
        for(let obj in data){
          if(this.roomId == data[obj].id_room){
            this.room = data[obj].name
          }
        }
      }
      getQuery(this,myPath + 'application/api/rooms/').then(roomData,null)
      
  
    },
    getUsers(){
      let succ = (result) => {
        this.usersArr = result
      }


     getQuery(this,myPath + 'application/api/users/').then(succ,null)
    
    }, 
    checkAdmin(){
      let adminCheck = (result) => {        
        if(result.id_role == "1"){
          this.admin = true
        }else{
          this.admin = false
          this.userId = getCookie('id')
        }
      }
      getQuery(this,myPath + 'application/api/auth/').then(adminCheck,null)
    },
    editBookRoom(){
      let now = new Date()
      
      var timeStartH = this.timeStartHour
      var timeEndH = this.timeEndHour
      if(this.timeStartMidnight == '1'){
        timeStartH += 12
      }
      
      if(this.timeEndMidnight == '1'){
        timeEndH += 12
      }

      let eventStart = new Date(this.yearsArr[this.year],this.month,this.days[this.day],timeStartH,this.timeStartMin)

      let eventEnd = new Date(this.yearsArr[this.year],this.month,this.days[this.day],timeEndH,this.timeEndMin)

      let data = {
        roomId:this.roomId,
        eventId:this.$route.params.id,
        user:this.user,
        dayCreation: new Date(now.getFullYear(), now.getMonth(), now.getDate()).getTime() / 1000,
        startEvent:eventStart.getTime() / 1000,
        endEvent:eventEnd.getTime() / 1000,
        recurring:this.recurring,
      }

      let eventGet = (result) =>{
       window.opener.getDelete(true,result,'edit')
        
       window.close()
      }
      if(this.formCheck()){
        putQuery(this,myPath + 'application/api/events/',data).then(eventGet,null)  
      }
      
      
    }
  },
  watch:{
    month(newMonth){
      this.setDateSelect(newMonth)
    
    },
    roomId(){
      this.getRooms()
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
.row{
  margin-bottom:15px;
}

.marg{
  margin-bottom:15px;
}
</style>
