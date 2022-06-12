@if (isset($paginator) && $paginator->hasPages())
    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
    >
                <span class="flex items-center col-span-3">
                  Showing {{ $paginator->count() }}  of {{ $paginator->total() }}
                </span>
        <span class="col-span-2"></span>
        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                      <li>
                          <a @if ($paginator->onFirstPage()) class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple cursor-not-allowed"
                             aria-disabled="true"
                             @else
                                 class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                             href="{{ $paginator->previousPageUrl() }}" @endif
                             aria-label="Previous"
                          >
                          <svg
                              class="w-4 h-4 fill-current"
                              aria-hidden="true"
                              viewBox="0 0 20 20"
                          >
                            <path
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                                fill-rule="evenodd"
                            ></path>
                          </svg>
                        </a>
                      </li>
                        @foreach ($elements as $element)

                            @if($paginator->currentPage() > 3)
                                <li><a
                                        class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                                        href="{{ $paginator->url(1) }}">
                          1
                        </a>
                            </li>
                            @endif

                            @if($paginator->currentPage() > 4)
                                <li><span class="px-3 py-1">...</span></li>
                            @endif
                            @foreach(range(1, $paginator->lastPage()) as $i)
                                @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                                    @if ($i == $paginator->currentPage())
                                        <li>
                                            <a class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                                <span>{{ $i }}</span>
                                            </a>
                                        </li>
                                    @else
                                        <li>
                        <a
                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                            href="{{ $paginator->url($i) }}">
                          {{ $i }}
                        </a>
                      </li>
                                    @endif
                                @endif
                            @endforeach
                            @if($paginator->currentPage() < $paginator->lastPage() - 3)
                                <span class="px-3 py-1">...</span>
                            @endif
                            @if($paginator->currentPage() < $paginator->lastPage() - 2)
                                <li><a class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                                       href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
                            @endif
                        @endforeach


                        <li>
                          <a @if ($paginator->hasMorePages())
                                 class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                             href="{{ $paginator->nextPageUrl() }}"
                             @else
                                 class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple cursor-not-allowed"
                             aria-disabled="true"
                             @endif
                             aria-label="Previous"
                          >
                          <svg
                              class="w-4 h-4 fill-current"
                              aria-hidden="true"
                              viewBox="0 0 20 20"
                          >
                              <path
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"
                                  fill-rule="evenodd"
                              ></path>
                          </svg>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </span>
    </div>
@endif
