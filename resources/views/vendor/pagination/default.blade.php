@if ($paginator->hasPages())
	<nav aria-label="pagination">
		<ul class="pagination pagination-circle pg-blue justify-content-center">
			{{-- Previous Page Link --}}
			@if ($paginator->onFirstPage())
				<!--First-->
				<li class="page-item disabled">
					<a href="#" class="page-link">First</a>
				</li>
				
				<li class="page-item disabled">
					<span class="page-link">&laquo;</span>
					<span class="sr-only">Next</span>
				</li>
			@else
				<!--First-->
				<li class="page-item">
					<a href="{{ $paginator->url(1) }}" class="page-link">First</a>
				</li>
				
				<li class="page-item">
					<a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link">&laquo;</a>
				</li>
			@endif

			{{-- Pagination Elements --}}
			@foreach ($elements as $element)
				{{-- "Three Dots" Separator --}}
				@if (is_string($element))
					<li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
				@endif

				{{-- Array Of Links --}}
				@if (is_array($element))
					@foreach ($element as $page => $url)
						@if ($page == $paginator->currentPage())
							<li class="page-item active"><span class="page-link">{{ $page }}</span></li>
						@else
							<li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
						@endif
					@endforeach
				@endif
			@endforeach

			{{-- Next Page Link --}}
			@if ($paginator->hasMorePages())
				<li class="page-item">
					<a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
					<span class="sr-only">Next</span>
				</li>
				
				<!--Last-->
				<li class="page-item">
					<a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">Last</a>
				</li>
			@else
				<li class="page-item disabled">
					<span class="page-link">&raquo;</span>
					<span class="sr-only">Next</span>
				</li>
				
				<!--Last-->
				<li class="page-item disabled">
					<a href="#" class="page-link">Last</a>
				</li>
			@endif
		</ul>
	</nav>
@endif
