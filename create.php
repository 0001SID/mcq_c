<!doctype html>
<html lang="en">

<head>
  <title>MCQ</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-3">
      <div class="alert alert-success alert-dismissible fade fixed-top" role="alert" id = "success">
          Question added successfully.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="alert alert-danger alert-dismissible fade fixed-top" role="alert" id = "failed">
          Question added failed
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="alert alert-danger alert-dismissible fade fixed-top" role="alert" id = "require">
          Please fill Chapter, question and all option field
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <form action="" method="post">
      <div class="row">

        <div class="col">
          <div class="form-group">
            <label for="chapter" class="font-weight-bold">Chapter</label>
            <input type="text" required class="form-control" name="chapter" id="chapter" placeholder="Chapter">
          </div>
          <div class="form-group">
            <label for="question" class="font-weight-bold">Question</label>
            <input required autocomplete = "off" type="text" class="form-control" name="question" id="question" placeholder="Place your question">
          </div>
          <div class="form-group">
            <label for="code" class="font-weight-bold">Code (If any)</label>
            <textarea class="form-control" name="code" id="code" rows="6"></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <input required autocomplete = "off" type="text" class="form-control" name="op1" id="op1" placeholder="Option 1">
          </div>
          <div class="form-group">
            <input required autocomplete = "off" type="text" class="form-control" name="op2" id="op2" placeholder="Option 2">
          </div>
          <div class="form-group">
            <input required autocomplete = "off" type="text" class="form-control" name="op3" id="op3" placeholder="Option 3">
          </div>
          <div class="form-group">
            <input required autocomplete = "off" type="text" class="form-control" name="op4" id="op4" placeholder="Option 4">
          </div>
          <p><strong>Last Question:</strong><p id = "lastQ"></p></p>
        </div>
        <div class="col">
          <div class="container">
            <div class="form-group">
              <label for="answer">Answer</label>
              <select class="custom-select" name="answer" id="answer">
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>
            <div class="form-group">
              <label for="explanation">Explanation</label>
              <textarea class="form-control" name="explanation" id="explanation" rows="3"></textarea>
            </div>
          </div>
          <div class="container">
            <button type="button" onclick = "addQuestion()" class="btn btn-primary px-5 mt-1">Submit</button>
          </div>
        </div>
      </div>
    </form>
    
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>