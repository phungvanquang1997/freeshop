<!-- block category -->
<div class="block left-module">
    <p class="title_block">{{ $category->name }}</p>
    <div class="block_content">
        <!-- layered -->
        <div class="layered layered-category">
            <div class="layered-content">
                <ul class="tree-menu">
                    @if (count($children))
                        @foreach ($children as $child)
                            <li><span></span><a href="{{ url('c/' . $child->slug) }}">{{ $child->name }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <!-- ./layered -->
    </div>
</div>
<!-- ./block category  -->