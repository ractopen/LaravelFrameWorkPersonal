<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Relationships Demo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
        .container { max-width: 800px; margin: 0 auto; }
        h1, h2, h3 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; font-weight: bold; }
        form { margin: 20px 0; }
        input, textarea, select { width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; }
        button { padding: 10px 15px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        button:disabled { background: #ccc; cursor: not-allowed; }
        .success { background: #d4edda; color: #155724; padding: 10px; margin: 10px 0; border: 1px solid #c3e6cb; }
        .info-box { background: #f8f9fa; padding: 15px; margin: 15px 0; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🥷 Laravel Eloquent Relationships Demo</h1>
        <p>Simple demonstration of One-to-Many and Many-to-One relationships.</p>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <h2>🏯 Existing Dojos & Ninjas</h2>

        @foreach($dojos as $dojo)
            <h3>🏯 {{ $dojo->name }}</h3>
            @if($dojo->description)
                <p>{{ $dojo->description }}</p>
            @endif

            <p><strong>🥷 Ninjas in this dojo:</strong></p>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Skill</th>
                        <th>Bio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dojo->ninjas as $ninja)
                        <tr>
                            <td>{{ $ninja->name }}</td>
                            <td>{{ $ninja->skill }}/100</td>
                            <td>{{ Str::limit($ninja->bio, 30) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p>📊 Total Ninjas: {{ $dojo->ninjas->count() }}</p>
            <br>
        @endforeach

        @if($ninjas->count() > 0)
            <h3>🥷 All Ninjas (Many-to-One View)</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Skill</th>
                        <th>Dojo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ninjas as $ninja)
                        <tr>
                            <td>{{ $ninja->name }}</td>
                            <td>{{ $ninja->skill }}/100</td>
                            <td>
                                @if($ninja->dojo)
                                    {{ $ninja->dojo->name }}
                                @else
                                    No dojo
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h2>➕ Create New Records</h2>

        <h3>🏯 Create New Dojo</h3>
        <form action="/dojos" method="POST">
            @csrf
            <label for="dojo_name">Dojo Name:</label><br>
            <input type="text" id="dojo_name" name="name" required><br><br>

            <label for="dojo_description">Description:</label><br>
            <textarea id="dojo_description" name="description"></textarea><br><br>

            <button type="submit">➕ Create Dojo</button>
        </form>

        <h3>🥷 Create New Ninja</h3>
        @if($dojos->count() > 0)
            <form action="/ninjas" method="POST">
                @csrf
                <label for="ninja_name">Ninja Name:</label><br>
                <input type="text" id="ninja_name" name="name" required><br><br>

                <label for="ninja_dojo">Assign to Dojo:</label><br>
                <select id="ninja_dojo" name="dojo_id" required>
                    <option value="">Select a dojo...</option>
                    @foreach($dojos as $dojo)
                        <option value="{{ $dojo->id }}">{{ $dojo->name }}</option>
                    @endforeach
                </select><br><br>

                <label for="ninja_skill">Skill Level (1-100):</label><br>
                <input type="number" id="ninja_skill" name="skill" min="1" max="100" required><br><br>

                <label for="ninja_bio">Bio:</label><br>
                <textarea id="ninja_bio" name="bio" required></textarea><br><br>

                <button type="submit">➕ Create Ninja</button>
            </form>
        @else
            <div class="info-box">
                <p>⚠️ You need to create a dojo first before you can create ninjas!</p>
                <button disabled>➕ Create Ninja (No Dojos Available)</button>
            </div>
        @endif
    </div>
</body>
</html>
