<div class="mail-container">
    <div class="hello-user">
        Your son's score
        <table>
            <tr>
                <th>Subject</th>
                <th>Score</th>
            </tr>
            @forelse ($user->scores as $score)
                <tr>
                    <td>{{ $score->paper->title }}</td>
                    <td>{{ $score->score }}</td>
                </tr>
            @empty
            @endforelse
        </table>
    </div>
    <div class="user-data">
    </div>
