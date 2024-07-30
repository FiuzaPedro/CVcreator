<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CV Output</title>
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Fonts -->    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/cv.css') }}">        
    <!-- /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */ -->
    <!-- Styles -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspdf-html2canvas@latest/dist/jspdf-html2canvas.min.js"></script>
    
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div id="loader" class=" text-primary" style="display: none; position:fixed; top:0; left:0; width: 100%; height:100%;z-index: 99999;
    background-color:rgba(0,0,0,0.7)">
        <div class="loaderContent" style="margin-top:20%; width:100%; text-align: center;">
            <div class="spinner-border text-primary"></div>
            <h1 style="width: 100%" class="h2 text-primary">Please Wait! PDF is being created, it may take a while...</h1>
        </div>
    </div>
    <button style="margin: 50px;" onclick="Convert_HTML_To_PDF()">Save CV</button>    
    <a style="background-color: teal !important;color: white;padding: 10px; border-radius:5px; text-decoration: none;" href="{{route('dashboard')}}">Return to Dashboard</a>
    <div id="cvContent">
        <div class="leftSideContainer">
            <!-- profile image -->
            <div class="imgWrapper">                
                @if ($imgSrc)
                    <img class="imgProfile" alt="profile picture"  src="{{ $imgSrc }}" />    
                @else
                    <p>No Picture uploaded</p>
                @endif                
            </div>    
            <!-- contact information -->
            <h2 style="display:flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
  <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
</svg>&nbsp;Contact</h2>            
            <strong class="subtitles">Email</strong>
            <p style="background-color:rgba(0, 0, 0, 0.4); padding:2px">&nbsp;{{Auth::user()->email}}</p>
            <strong class="subtitles">Phone</strong>
            <p style="background-color:rgba(0, 0, 0, 0.4); padding:2px">&nbsp;+{{Auth::user()->phone}}</p>
            <!-- education -->
            <h2 style="display:flex"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stack" viewBox="0 0 16 16">
  <path d="m14.12 10.163 1.715.858c.22.11.22.424 0 .534L8.267 15.34a.6.6 0 0 1-.534 0L.165 11.555a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.66zM7.733.063a.6.6 0 0 1 .534 0l7.568 3.784a.3.3 0 0 1 0 .535L8.267 8.165a.6.6 0 0 1-.534 0L.165 4.382a.299.299 0 0 1 0-.535z"/>
  <path d="m14.12 6.576 1.715.858c.22.11.22.424 0 .534l-7.568 3.784a.6.6 0 0 1-.534 0L.165 7.968a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0z"/>
</svg>&nbsp;Education</h2>            
            @for ($j = 0 ; $j < count($educationDate); $j++)
                <div style="border: .5px groove white; padding: 5px; background-color:rgba(0, 0, 0, 0.4); box-shadow: -10px 0px 20px white">
                    <p style="font-size:.9em; margin-bottom: 10px">
                        <strong style="background-color:#d4ac6e; padding:3px; border-radius:50px; ">{{$educationDate[$j]}}</strong>
                    </p>
                    <p style="font-size:.9em">{!! $location[$j] !!}</p>
                </div>
            @endfor                
            <!-- skills -->
            <h2 style="display:flex"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
  <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3q0-.405-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708M3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
</svg>&nbsp;Skills</h2>
            <div class="skillsContainer">
                <h4 class="hSkills" style="font-size:.9em">Technical Skills:</h4>
                <ul style="margin-top:5px">
                    @foreach ($techskills as $techskill)
                        <li style="font-size: .9em;">{{$techskill}}</li>
                    @endforeach
                </ul>
                <h4 class="hSkills" style="font-size:.9em">Soft Skills:</h4>
                <ul style="margin-top:5px">
                    @foreach ($softskills as $softskill)
                        <li style="font-size: .9em;">{{$softskill}}</li>
                    @endforeach
                </ul>                
            </div>  
            <h2 style="display:flex"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
  <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
</svg>&nbsp;Languages</h2>                      
            <div class="languagesContainer" >
                <h6 class="hLang">Portuguese</h6>   
                <div class="outerRangeDiv" >
                    <?php echo '<div style="background-color: #d4ac6e; height: 100%; width: ' . $ptLevel .  '%"></div>' ?>
                </div>
                <h6 class="hLang">English</h6>
                <div class="outerRangeDiv" >
                    <?php echo '<div style="background-color: #d4ac6e; height: 100%; width: ' . $ukLevel .  '%"></div>' ?>
                </div>
                <h6 class="hLang">French</h6>
                <div class="outerRangeDiv" >
                    <?php echo '<div style="background-color: #d4ac6e; height: 100%; width: ' . $frLevel .  '%"></div>' ?>
                </div>
                <h6 class="hLang">German</h6>
                <div class="outerRangeDiv" >
                    <?php echo '<div style="background-color: #d4ac6e; height: 100%; width: ' . $deLevel .  '%"></div>' ?>
                </div>
            </div>
            <div class="divLinkedin">
                <img class="imgLinked" src={{asset("\images\linkedin.png")}} alt="linkedIn icon">
                <a style="text-decoration: none;" href="{{Auth::user()->linkedin}}" target="_blank">{{Auth::user()->linkedin}}</a>
                <!-- <a href="https://www.flaticon.com/free-icons/linkedin" title="linkedin icons">Linkedin icons created by riajulislam - Flaticon</a> -->
            </div>
        </div>
        <div class="rightSideContainer">            
            <div class="userDetailsContainer">
                <h1 id="nameTitle">{{$name}}</h1>
                <h3 class="hRole"><div>{{Auth::user()->role}}</div></h3>
                <p class="aboutTxt">{{$about}}</p>                
            </div>
            <div class="experienceContainer">
                <h2 style="display:flex; align-items:center"><svg xmlns="http://www.w3.org/2000/svg" width="37" height="41" fill="currentColor" class="bi bi-laptop" viewBox="0 0 16 16">
  <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5"/>
</svg>&nbsp;&nbsp;Experience</h2>
                @if (!empty($expDate))
                @for ($i = 0; $i < count($expDate); $i++)                    
                    <div class="individualExperience" style="background-color: teal; color:white; margin-bottom: 10px; padding:10px 0px 10px 10px">
                        <p style="font-size: 1.2em;">{{$expDate[$i]}}</p>
                        <p style="font-size:1em; background-color: rgba(0, 0, 0, 0.4);">{!! $workplace[$i] !!}</p>
                        <p style="margin-top: 10px; font-size: 1.1em; "><strong>{{$position[$i]}}</strong></p>
                        <p>{!! $jobdescription[$i] !!}</p>
                    </div>
                @endfor    
                @endif
                
            </div>
        </div>
    </div>
</body>
<script>
    let currentName = document.getElementById('nameTitle').innerText.trim();
    console.log(currentName)
    async function Convert_HTML_To_PDF() { 
        const loader = document.getElementById('loader')       
        loader.style.display = 'block';
        
        var pages = document.getElementById('cvContent'); 
        const pdf = await html2PDF( pages, {                        
            jsPDF: {                
                format: 'a4',            
                orientation: 'portrait'                
            },            
            margin: {
                top: 5,
                right: 10,
                bottom: 5,
                left: 10,                
            },               
            output: 'CV.pdf'
        });
    
        loader.style.display = 'none'
    }//end ConvertHTMLtoPDF function   
</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>