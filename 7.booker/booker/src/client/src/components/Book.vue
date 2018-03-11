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
        <div class="col-md-12"><p class="text-left">2. I would like to book this meeting:</p></div>
        <div class="col-md-4">
          <select  v-model="month" class="form-control">
            <option :value="key"  v-for="(month,key) in monthArr">{{month}}</option>
          </select>
        </div>
        <div class="col-md-4">
          <select v-model="day" class="form-control">
            <option :value="key" v-for="(day,key) in days">{{day}}</option>
          </select>
        </div>
        <div class="col-md-4">
          <select v-model="year"  class="form-control">
            <option :value="key" v-for="(year,key) in yearsArr">{{year}}</option>
          </select>
        </div>
        <div class="col-md-12" v-if="dateMsg"><p class="text-left text-danger">{{dateMsg}}</p></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="col-md-12"><p class="text-left">3. Specify what the time and end of the meeting(This will be what people see on the calendar.)</p></div>
          <div class="col-md-12" v-if="timeStartMsg"><p class="text-left text-danger">{{timeStartMsg}}</p></div>
          <div class="col-md-12" v-if="timeEndMsg"><p class="text-left text-danger">{{timeEndMsg}}</p></div>
        <div class="col-md-4 marg">
          <select  v-model="timeStartHour" class="form-control">
            <option :value="hour"  v-for="hour in 12">{{hour}}</option>
          </select>
        </div>
        <div class="col-md-4 marg">
          <select v-model="timeStartMin" class="form-control">
            <option value="0" >0</option>
            <option :value="minute * 15" v-for="minute in 3">{{minute * 15}}</option>
          </select>
        </div>
        <div class="col-md-4 marg">
          <select v-model="timeStartMidnight"  class="form-control">
            <option value="0">AM</option>
            <option value="1">PM</option>
          </select>
        </div>
        <div class="col-md-4">
          <select  v-model="timeEndHour" class="form-control">
            <option :value="hour"  v-for="hour in 12">{{hour}}</option>
          </select>
        </div>
        <div class="col-md-4">
          <select v-model="timeEndMin" class="form-control">
            <option value="0" >0</option>
            <option :value="minute * 15" v-for="minute in 3">{{minute * 15}}</option>
          </select>
        </div>
        <div class="col-md-4">
          <select v-model="timeEndMidnight"  class="form-control">
            <option value="0">AM</option>
            <option value="1">PM</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="col-md-12">
          <p class="text-left">4. Enter the specifics for the meetings(This will be what peolpe see when they click on an. event link.)</p>
          <p v-if="descMsg" class="text-left text-danger">{{descMsg}}</p>
          <textarea v-model="desc" class="form-control" rows="5"></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4 text-left">
        <div class="col-md-12">
          <p >It's going to be recurring event?</p>
          <div class="radio">
            <label>
              <input v-model="recurring" type="radio" name="optionsRadios" id="optionsRadios1" :value="false" checked>
              No
            </label>
          </div>
          <div class="radio">
            <label>
              <input v-model="recurring" type="radio" name="optionsRadios" id="optionsRadios2" :value="true">
              Yes
            </label>
          </div>
        </div>
      </div>
    </div>
    <div v-if="recurring" class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="col-md-12 text-left">
          <p>5. If it's recurring specify weekly, bi-weekly, or monthly</p>
          <div class="radio">
            <label>
              <input v-model="recurringType" type="radio" name="recurringType" id="recurringType1" :value="1" checked>
              weekly
            </label>
          </div>
          <div class="radio">
            <label>
              <input v-model="recurringType" type="radio" name="recurringType" id="recurringType2" :value="2">
             bi-weekly
            </label>
          </div> 
          <div class="radio">
            <label>
              <input v-model="recurringType" type="radio" name="recurringType" id="recurringType3" :value="3">
            monthly 
            </label>
          </div>
          <p>6. If weekly or be weekly, specify number of weeks for it to keep recurring. If monthly, specify the number of months</p>
          <div class="col-md-7" v-if="recurringType != 3">
            <p v-if="recMsg" class="text-left text-danger">{{recMsg}}</p>
            <input v-model="recurringDuration" class="form-control" type="text">
            <label>duration(max 4 weeks)</label>
          </div>
          <div class="col-md-7" v-if="recurringType == 3">
            <input v-model="recurringDuration"  :value="recurringDuration = 1"  disabled class="form-control" type="text">
            <label>duration(max 4 weeks)</label>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <button v-on:click="bookRoom" type="button" class="btn btn-success">Book</button>
        <div v-if="notBookedArr.length > 0" class="bg-danger danger-mrg">
          <p class="text-danger">Was not booked:</p>
          <p class="text-danger" v-for="day in notBookedArr">{{day.start | dateFormat}} - {{day.end | dateFormat}}</p>
        </div>
     </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'book',
  data () {
    return {
    msg:'book',
    room:'',
    roomId:'',
    usersArr:[],
    user:'1',
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
    timeStartHour:8,
    timeEndHour:8,
    timeStartMin:0,
    timeEndMin:0,
    timeStartMidnight:'0',
    timeEndMidnight:'0',
    recurring:false,
    recurringType:1,
    recurringDuration:'',
    desc:'',
    admin:false,
    nowDate:new Date(Date.now()),
    dateMsg:'',
    timeStartMsg:'',
    timeEndMsg:'',
    descMsg:'',
    recMsg:'',
    notBookedArr:[]
    }
  },
  created(){
    this.checkAdmin()
    this.getRooms()
    this.getUsers()
    this.setDateSelect()
  },
  methods: {
    formCheck(){
      this.dateMsg = ''
      this.timeStartMsg = ''
      this.timeEndMsg = ''
      this.descMsg = ''
      this.recMsg = ''
      if(Number(this.yearsArr[this.year]) >= this.nowDate.getFullYear()){
        var year = true
      }else{
        this.dateMsg += 'wrong year, '
        var year = false 
      }

      if(this.month >= this.nowDate.getMonth()){
        var month = true
      }else{
        this.dateMsg += 'wrong month '
        var month = false 
      }
      if(this.days[this.day] >= this.nowDate.getDate() || this.month > this.nowDate.getMonth()){
        var day = true
      }else{
        this.dateMsg += ' wrong day'
        var day = false 
      }

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
      
      if(this.desc.length >= 5){
       var desc = true 
      }else{
       var desc = false
       this.descMsg = 'description is to short'
      }

      if(year && month && day && hourS && hourE && desc && hourEqv){
        return true
      }else{
        return false
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
          if(this.$route.params.id_room == data[obj].id_room){
            this.room = data[obj].name
            this.roomId = data[obj].id_room  
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
          this.user = getCookie('id')
        }
      }
      getQuery(this,myPath + 'application/api/auth/').then(adminCheck,null)
    },
    bookRoom(){
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
        roomId:this.$route.params.id_room,
        user:this.user,
        dayCreation: new Date(now.getFullYear(), now.getMonth(), now.getDate()).getTime() / 1000,
        startEvent:eventStart.getTime() / 1000,
        endEvent:eventEnd.getTime() / 1000,
        desc:this.desc,
        recurring:this.recurring,
      }

      if(data.recurring){
        data.recType = this.recurringType
        data.recDuration = this.recurringDuration
      }

      let eventGet = (result) =>{
        if(result == true || result.length == 0){
          this.$router.push('/calendar')  
        }else{
          var dt = new Date()
          for(let date in result){
            this.notBookedArr.push(result[date])
          }
        }
      }
     if(this.formCheck()){
      postQuery(this,myPath + 'application/api/events/',data).then(eventGet,null)
     }
      
    }
  },
  watch:{
    month(newMonth){
      this.setDateSelect(newMonth)
    
    },
    recurringDuration(){
      if(this.recurringType == 1 || this.recurringType == 2){
        if(this.recurringDuration.search(/[1-4]/) != 0 || this.recurringDuration.length > 1){
          this.recurringDuration = ''
          this.recMsg = 'value must be beatween 1-4 number'
        }else{
          this.recMsg = ''
        }
      }
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
.row{
  margin-bottom:15px;
}

.marg{
  margin-bottom:15px;
}
.danger-mrg{
  margin-top: 25px;
}
</style>
