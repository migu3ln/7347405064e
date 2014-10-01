<!-- The template to display files available for download -->
<?php if ($this->multiple) : ?>
    <script id="template-download-preview" type="text/x-tmpl">

        {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
        {% if (file.error) { %}
        <td></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else { %}
        <td class="preview">{% if (file.url) { %}
        <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img width="150" height="150" src="{%=file.url%}"></a>
        {% } %}</td>
        <td class="name">
        <a href="{%=file.url%}" class='imageslink' url="{%=file.url%}"  title="{%=file.name%}" filename="{%=file.filename%}" rel="{%=file.url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
        </td> 
        {% } %}
        <td class="delete">
        <button class="btn-mini btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
        <i class="icon-trash icon-white"></i>
        <span>{%=locale.fileupload.destroy%}</span>
        </button>
        <?php if ($this->multiple) : ?><input type="checkbox" name="delete" value="1">-->
        <?php else: ?><input type="hidden" name="delete" value="1">
        <?php endif; ?>
        </td>
        </tr>
        {% } %}

    </script>
<?php else: ?>
    <script id="template-download-preview" type="text/x-tmpl">
          {% for (var i=0, file; file=o.files[i]; i++) { %}
            {% if (file.url) { %}
                    <div class="thumbnail template-download fade" >
                        <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}">
                          <img class='imageslink'  url="{%=file.url%}"  title="{%=file.name%}" filename="{%=file.filename%}" rel="{%=file.url&&'gallery'%}" width="150" height="150" src="{%=file.url%}">
                        </a>
                        <div class="caption">
                            <p class='delete'>
                                <button class="btn-mini btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                                    <i class="icon-trash icon-white"></i>
                                    <span>{%=locale.fileupload.destroy%}</span>
                                </button> 
                                <input type="hidden" name="delete" value="1">
                            </p>
                        </div>
                    </div>
             {% } %}
           {% } %}
    </script>
<?php endif; ?>
