<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Q&A</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center mt-5">Q&A</h1>
    
    <!--QA-->    
    <div class="accordion mt-4  mb-4 m-3 " id="q1" >
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="accordion-button collapsed text-bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#bq1" aria-expanded="false" aria-controls="bq1">
              {{$question}}
            </button>
          </h3>
          <div id="bq1" class="accordion-collapse collapse" data-bs-parent="#q1">
            <div class="accordion-body">
              {{$answer}}
            </div>
          </div>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>