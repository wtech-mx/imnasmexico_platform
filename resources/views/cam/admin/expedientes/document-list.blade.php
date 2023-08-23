<ul>
    @foreach ($documents as $document)
        <li>{{ $document->name }} - <a href="{{ asset('storage/documents/' . $document->filename) }}" target="_blank">Ver documento</a></li>
    @endforeach
</ul>
