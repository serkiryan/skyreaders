<!DOCTYPE HTML>
<html>
  <head>
      <title></title>
      <style>
        body{
          font-family: DejaVu Sans;
        }
        table {
          border-collapse: collapse;
        }
        table, th, td {
          border: 1px solid black;
        }
      </style>
  </head>
  <body class="bg-success">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Имя</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Количество прочитанных книг</th>
          </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->books->count()}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
  </body>
</html>