<h2>Додати запис</h2>

<p>{{ content() }}</p>

<form method="post">

<p>
    <label for="name">Title</label>
    {{ tag.textField("title") }}
</p>

<p>
    <label for="email">Content</label>
    {{ tag.textArea("content") }}
</p>

<p>
    {{ tag.submitButton("Додати") }}
</p>

</form>