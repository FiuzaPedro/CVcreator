<title>CV Generator</title>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">    
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight p-2">
        Welcome <span style="color: teal">{{Auth::user()->name}}</span><span style="margin-left: 5%;">{{Auth::user()->role}}</span>
        </h2>
    </x-slot>    

    <div class="py-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <form id="frmCv" action="{{ route('createCv') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="userDetails">
                                <div class="imgWrapper">                                       
                                    <img class="imgProfile" @if(Auth::user()->photo !== '') src="{{asset('storage/'. Auth::user()->photo)}}" @else src="\images\4x3\not_available.svg" @endif alt="profile picture" >
                                    <input style="visibility:hidden; height:0;" type="text" name="imgSrc" id="" @if(Auth::user()->photo !== '') value="{{asset('storage/'. Auth::user()->photo) }}" @else value="\images\4x3\not_available.svg" @endif>
                                </div>                                
                                <textarea name="about" id="about" rows="5" placeholder="Some text about yourself">{{Auth::user()->about}}</textarea>                                                                                                                                            
                        </div>                        
                        <hr>                         
                        <div class="fullContainer">                        
                            <div class="leftContainer">
                                <fieldset>
                                    <legend>Competencies:</legend>
                                    <label style="height:20px;" for="softskills">Soft skills:</label>                                    
                                    <input type="text" class="skills" id="softskills" name="softskills" {{Auth::user()->softskills !== '' ? 'value='. Auth::user()->softskills . '' : 'value=""' }}>
                                    <label style="height:20px; margin-top:5px;" for="techskills">Technical
                                        skills:</label>
                                    <input type="text" class="skills" id="techskills" name="techskills" {{Auth::user()->techskills !== '' ? 'value='. Auth::user()->techskills . '' : 'value=""' }}> <br>
                                    <p style="font-size: 12px">Choose your language level:</p>
                                    <span class="languages">
                                        <img src="images/4x3/pt.svg" alt="pt flag">
                                        <input type="range" name="ptLevel" id="" value="100">
                                    </span>
                                    <span class="languages">
                                        <img src="images/4x3/uk.svg" alt="uk flag">
                                        <input type="range" name="ukLevel" id="" value="90">
                                    </span>
                                    <span class="languages">
                                        <img src="images/4x3/de.svg" alt="de flag">
                                        <input type="range" name="deLevel" id="" value="40">
                                    </span>
                                    <span class="languages">
                                        <img src="images/4x3/fr.svg" alt="fr flag">
                                        <input type="range" name="frLevel" id="" >
                                    </span>                                    
                                </fieldset>                                
                            </div>
                            <div class="rightContainer">
                                <fieldset id="expField">
                                    <legend>Experiences:</legend>
                                    @if (!empty($experiences))
                                        @foreach ($experiences as $experience )
                                            <label for="expDate">Date:</label>
                                            <input class="dateInput" name="expDate[]" disabled  type="text" required value="{{$experience->exp_date}}">
                                            <label for="workplace">Workplace:</label>
                                            <input class="placeInput" name="workplace[]" disabled  type="text" required value="{{$experience->workplace}}">
                                            <label for="position">Position:</label>
                                            <input class="positionInput" name="position[]"  disabled type="text" required value="{{$experience->position}}">
                                            <input type="hidden" class="experienceId" name="experienceId" value="{{$experience->id}}">
                                            <a class="btnRemove" href="{{route('delete', [$type= 'exp' ,$experience->id])}}">Delete</a>
                                            <!-- <input type="text" name="jobdescription[]" disabled class="jobdescription" placeholder="Job Description here" required value="{{$experience->description}}">     -->
                                            <textarea class="jobinfo" name="jobdescription[]" disabled style="width: 100%; font-size:.9em" >{{$experience->description}}</textarea>
                                            <hr style="margin: 15px 0;">
                                        @endforeach                                        
                                    @endif                                                                        
                                    <div id="expDiv"></div>
                                    <button type="button" class="btnAdd" id="btnExperiences">Add Item</button>
                                    <!-- <button type="button" class="btnRemove" id="btnRemoveExp">Remove Item</button> -->
                                </fieldset>
                                <fieldset>                                    
                                    <legend>Education:</legend>
                                    @if (!empty($educations))
                                        @foreach ($educations as $education)
                                            <label for="educationDate">Date:</label>
                                            <input class="dateInput" name="educationDate[]" disabled type="text" value="{{$education->edu_date}}">
                                            <label for="location">Location/Course Description:</label>
                                            <input class="locationInput" name="location[]" disabled type="text" value="{{$education->location}}">
                                            <input type="hidden" class="experienceId" name="educationId" value="{{$education->id}}">
                                            <a class="btnRemove" href="{{route('delete', [$type='edu', $education->id])}}">Delete</a>
                                            <br>
                                            <hr style="margin: 10px 0;">
                                        @endforeach
                                    @endif                                    
                                    <div id="eduDiv"></div>
                                    <button type="button" class="btnAdd" id="btnEducation">Add Item</button>
                                    
                                </fieldset>                                
                            </div>                             
                        </div>   
                        <!-- end full container -->
                        <input style="visibility: hidden; width: 0px;" type="text" name="name"  value="{{Auth::user()->name}}" />                                    
                        <input style="visibility: hidden; width: 0px;" type="text" name="role" value="{{Auth::user()->role}}" />                                                         
                        <input id="submitBtn" type="submit" value="Submit" />                           
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!-- Last Experience Id -->
        @if (count($experiences) > 0)
            {{$expIndex = $experiences[count($experiences)-1]->id }}
        @else
            {{$expIndex = 0}}
        @endif

        <!-- Last Education Id -->
        @if (count($educations) > 0)
            {{$eduIndex = $educations[count($educations)-1]->id }}
        @else
            {{$eduIndex = 0}}
        @endif
    <script type="module">
        (function () {

            // $('#submitBtn').click(function (e) {
            //     e.preventDefault();
            //     $('#frmCv').submit();
            // });
                        
            $('.btnAdd').click(function () {
                var expStatus = '', eduStatus = ''; 
                if ($(this).attr('id') === 'btnExperiences') {                   
                    
                    $('#expDiv :input').each(function () {                        
                        console.log($(this).val());
                        if($(this).val() === '') {                                 
                            return expStatus = "empty";                            
                        }
                    }) //end each function
                    if (expStatus === 'empty') {
                        return;
                    }   
                    $('#expDiv').append('<span class="addedItem"><label for="expDate">Date:</label><input required class="dateInput" name="expDate[]" type="text"><label for="workplace" style="margin: 0 7px">Workplace:</label><input required name="workplace[]" type="text"><label for="position" style="margin: 0 7px">Position:</label><input required class="positionInput" name="position[]" type="text">&nbsp;</span><button type="button" onclick="$(this).parent().empty()" class="btnRemove" value="btn">Undo</button><textarea class="jobinfo" name="jobdescription[]"></textarea><br><hr style="margin: 10px 0;">');
                    //<input required type="text" name="jobdescription[]" class="jobdescription" placeholder="Job Description here">
                    
                } else {                                      
                    $('#eduDiv :input').each(function () {                        
                        if($(this).val() === '') {                                
                            return eduStatus = "empty";
                        }
                    }) //end each function
                    if (eduStatus !== '') {
                        return;
                    }                 
                    $('#eduDiv').append('<span class="addedItem"><label for="educationDate">Date:</label><input required class="dateInput" name="educationDate[]" type="text"><label for="location" style="margin: 0 7px">Location/Course Description:</label><input required class="locationInput" name="location[]" type="text">&nbsp;<button type="button" onclick="$(this).parent().empty();" class="btnRemove" value="btn">Undo</button><hr class="addedHr" style="margin: 10px 0;"></span>')
                };
                
            }) //end btnAdd Click function          

            let skillsInputs = $('.skills');
            var spacebarHits = 0;
            skillsInputs.on('keydown', function (e) {
                // console.log(e.which);
                if (e.which === 32) {
                    spacebarHits+=1;
                    let lastChar = document.getElementById(e.target.id).value[document.getElementById(e.target.id).value.length-1];                    
                    //console.log(spacebarHits + "\n" + lastChar );
                    if (spacebarHits > 2 && lastChar !== ",") {
                        e.target.value+= ',';    
                        spacebarHits = 0;
                    }                    
                }
            })
            //end function to add commas after each skill

        })();
        //end anonymous function that simulates DOM loaded event
    </script>
</x-app-layout>