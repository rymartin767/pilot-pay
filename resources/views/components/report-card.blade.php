<div class="flex flex-col py-8 rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#b8adad] dark:bg-gradient-to-bl dark:from-gray-800 dark:to-gray-700 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
    <div class="w-full flex flex-col max-w-xl mx-auto px-3">
        <!-- TOTAL COMPENSATION HEADER -->
        <div class="text-center mb-5">
            <div class="font-black text-5xl text-stone-800 dark:text-white/75">{{ Number::currency($report->earnings->total_compensation ?? 0 ) }}</div>
            <div class="font-normal tracking-widest text-lg uppercase text-stone-800 dark:text-white/50">total compensation</div>
        </div>

        <!-- REPORT INFO/ATTRIBUTES -->
        <div class="flex flex-row space-x-4 items-center mb-3">
            <img src="{{ Storage::url($report->employer_logo_url) }}" class="h-16 w-auto rounded-md" alt="Airline Logo" loading="lazy" />
            <div class="flex flex-col font-semibold">
                <div class="text-base lg:text-xl text-stone-800 dark:text-white/75">{{ $report->employer }} · GTI</div>
                <div class="text-base text-stone-800 dark:text-white/50">{{ $report->fleet->name }} | {{ $report->seat }} | {{ $report->longevity }} Pay</div>
            </div>
        </div>

        <!-- REPORT EARNINGS -->
        <ul class="space-y-4 divide-y divide-gray-200">
            <li class="flex items-center pt-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="h-6 w-6 fill-current text-blue-900">
                    <path d="M160 0C177.7 0 192 14.33 192 32V67.68C193.6 67.89 195.1 68.12 196.7 68.35C207.3 69.93 238.9 75.02 251.9 78.31C268.1 82.65 279.4 100.1 275 117.2C270.7 134.3 253.3 144.7 236.1 140.4C226.8 137.1 198.5 133.3 187.3 131.7C155.2 126.9 127.7 129.3 108.8 136.5C90.52 143.5 82.93 153.4 80.92 164.5C78.98 175.2 80.45 181.3 82.21 185.1C84.1 189.1 87.79 193.6 95.14 198.5C111.4 209.2 136.2 216.4 168.4 225.1L171.2 225.9C199.6 233.6 234.4 243.1 260.2 260.2C274.3 269.6 287.6 282.3 295.8 299.9C304.1 317.7 305.9 337.7 302.1 358.1C295.1 397 268.1 422.4 236.4 435.6C222.8 441.2 207.8 444.8 192 446.6V480C192 497.7 177.7 512 160 512C142.3 512 128 497.7 128 480V445.1C127.6 445.1 127.1 444.1 126.7 444.9L126.5 444.9C102.2 441.1 62.07 430.6 35 418.6C18.85 411.4 11.58 392.5 18.76 376.3C25.94 360.2 44.85 352.9 60.1 360.1C81.9 369.4 116.3 378.5 136.2 381.6C168.2 386.4 194.5 383.6 212.3 376.4C229.2 369.5 236.9 359.5 239.1 347.5C241 336.8 239.6 330.7 237.8 326.9C235.9 322.9 232.2 318.4 224.9 313.5C208.6 302.8 183.8 295.6 151.6 286.9L148.8 286.1C120.4 278.4 85.58 268.9 59.76 251.8C45.65 242.4 32.43 229.7 24.22 212.1C15.89 194.3 14.08 174.3 17.95 153C25.03 114.1 53.05 89.29 85.96 76.73C98.98 71.76 113.1 68.49 128 66.73V32C128 14.33 142.3 0 160 0V0z" />
                </svg>
                <div class="flex flex-col sm:flex-row sm:items-center ml-4 font-poppins">
                    <div class="font-normal pt-1 text-slate-800">Gross W2 Wages:</div>
                    <div class="font-light pt-1 sm:ml-2 text-xl sm:text-base">{{ Number::currency($report->earnings->flight_pay ) }}</div>
                </div>
            </li>
            <li class="flex items-center pt-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="h-6 w-6 fill-current text-blue-900">
                    <path d="M115.4 136.8l102.1 37.35c35.13-81.62 86.25-144.4 139-173.7c-95.88-4.875-188.8 36.96-248.5 111.7C101.2 120.6 105.2 133.2 115.4 136.8zM247.6 185l238.5 86.87c35.75-121.4 18.62-231.6-42.63-253.9c-7.375-2.625-15.12-4.062-23.12-4.062C362.4 13.88 292.1 83.13 247.6 185zM521.5 60.51c6.25 16.25 10.75 34.62 13.13 55.25c5.75 49.87-1.376 108.1-18.88 166.9l102.6 37.37c10.13 3.75 21.25-3.375 21.5-14.12C642.3 210.1 598 118.4 521.5 60.51zM528 448h-207l65-178.5l-60.13-21.87l-72.88 200.4H48C21.49 448 0 469.5 0 496C0 504.8 7.163 512 16 512h544c8.837 0 16-7.163 16-15.1C576 469.5 554.5 448 528 448z" />
                </svg>
                <div class="flex flex-col sm:flex-row sm:items-center ml-4 font-poppins">
                    <div class="font-normal pt-1 text-slate-800">Company Retirement Contribution:</div>
                    <div class="font-light pt-1 sm:ml-2 text-xl sm:text-base">{{ Number::currency($report->earnings->employer_retirement_contribution ) }}</div>
                </div>
            </li>
            <li class="flex items-center pt-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="h-6 w-6 fill-current text-blue-900">
                    <path d="M568.2 336.3c-13.12-17.81-38.14-21.66-55.93-8.469l-119.7 88.17h-120.6c-8.748 0-15.1-7.25-15.1-15.99c0-8.75 7.25-16 15.1-16h78.25c15.1 0 30.75-10.88 33.37-26.62c3.25-20-12.12-37.38-31.62-37.38H191.1c-26.1 0-53.12 9.25-74.12 26.25l-46.5 37.74L15.1 383.1C7.251 383.1 0 391.3 0 400v95.98C0 504.8 7.251 512 15.1 512h346.1c22.03 0 43.92-7.188 61.7-20.27l135.1-99.52C577.5 379.1 581.3 354.1 568.2 336.3zM279.3 175C271.7 173.9 261.7 170.3 252.9 167.1L248 165.4C235.5 160.1 221.8 167.5 217.4 179.1s2.121 26.2 14.59 30.64l4.655 1.656c8.486 3.061 17.88 6.095 27.39 8.312V232c0 13.25 10.73 24 23.98 24s24-10.75 24-24V221.6c25.27-5.723 42.88-21.85 46.1-45.72c8.688-50.05-38.89-63.66-64.42-70.95L288.4 103.1C262.1 95.64 263.6 92.42 264.3 88.31c1.156-6.766 15.3-10.06 32.21-7.391c4.938 .7813 11.37 2.547 19.65 5.422c12.53 4.281 26.21-2.312 30.52-14.84s-2.309-26.19-14.84-30.53c-7.602-2.627-13.92-4.358-19.82-5.721V24c0-13.25-10.75-24-24-24s-23.98 10.75-23.98 24v10.52C238.8 40.23 221.1 56.25 216.1 80.13C208.4 129.6 256.7 143.8 274.9 149.2l6.498 1.875c31.66 9.062 31.15 11.89 30.34 16.64C310.6 174.5 296.5 177.8 279.3 175z" />
                </svg>
                <div class="flex flex-col sm:flex-row sm:items-center ml-4 font-poppins">
                    <div class="font-normal pt-1 text-slate-800">Company Profit Sharing/Bonus:</div>
                    <div class="font-light pt-1 sm:ml-2 text-xl sm:text-base">{{ Number::currency($report->earnings->profit_sharing ) }}</div>
                </div>
            </li>
            <li class="flex items-center pt-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-6 w-6 fill-current text-blue-900"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96v32V480H384V128 96 56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM96 96H64C28.7 96 0 124.7 0 160V416c0 35.3 28.7 64 64 64H96V96zM416 480h32c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H416V480zM224 208c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v48h48c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H288v48c0 8.8-7.2 16-16 16H240c-8.8 0-16-7.2-16-16V320H176c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h48V208z" />
                </svg>
                <div class="flex flex-col sm:flex-row sm:items-center ml-4 font-poppins">
                    <div class="font-normal pt-1 text-slate-800">Company Health Savings Contribution:</div>
                    <div class="font-light pt-1 sm:ml-2 text-xl sm:text-base">{{ Number::currency($report->earnings->employer_health_savings_contribution ) }}</div>
                </div>
            </li>
            <li class="flex items-center pt-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-6 w-6 fill-current text-blue-900"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d=" M160 32V64H288V32C288 14.33 302.3 0 320 0C337.7 0 352 14.33 352 32V64H400C426.5 64 448 85.49 448 112V160H0V112C0 85.49 21.49 64 48 64H96V32C96 14.33 110.3 0 128 0C145.7 0 160 14.33 160 32zM0 192H448V464C448 490.5 426.5 512 400 512H48C21.49 512 0 490.5 0 464V192zM64 304C64 312.8 71.16 320 80 320H112C120.8 320 128 312.8 128 304V272C128 263.2 120.8 256 112 256H80C71.16 256 64 263.2 64 272V304zM192 304C192 312.8 199.2 320 208 320H240C248.8 320 256 312.8 256 304V272C256 263.2 248.8 256 240 256H208C199.2 256 192 263.2 192 272V304zM336 256C327.2 256 320 263.2 320 272V304C320 312.8 327.2 320 336 320H368C376.8 320 384 312.8 384 304V272C384 263.2 376.8 256 368 256H336zM64 432C64 440.8 71.16 448 80 448H112C120.8 448 128 440.8 128 432V400C128 391.2 120.8 384 112 384H80C71.16 384 64 391.2 64 400V432zM208 384C199.2 384 192 391.2 192 400V432C192 440.8 199.2 448 208 448H240C248.8 448 256 440.8 256 432V400C256 391.2 248.8 384 240 384H208zM320 432C320 440.8 327.2 448 336 448H368C376.8 448 384 440.8 384 432V400C384 391.2 376.8 384 368 384H336C327.2 384 320 391.2 320 400V432z" />
                </svg>
                <div class="flex flex-col sm:flex-row sm:items-center ml-4 font-poppins">
                    <div class="font-normal pt-1 text-slate-800">Days Worked:</div>
                    <div class="font-light pt-1 sm:ml-2 text-xl sm:text-base">{{ $report->earnings->days_worked }}</div>
                </div>
            </li>
            <li class="flex items-center pt-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-6 w-6 fill-current text-blue-900"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512zM232 256C232 264 236 271.5 242.7 275.1L338.7 339.1C349.7 347.3 364.6 344.3 371.1 333.3C379.3 322.3 376.3 307.4 365.3 300L280 243.2V120C280 106.7 269.3 96 255.1 96C242.7 96 231.1 106.7 231.1 120L232 256z" />
                </svg>
                <div class="flex flex-col sm:flex-row sm:items-center ml-4 font-poppins">
                    <div class="font-normal pt-1 text-slate-800">Block Hours Flown:</div>
                    <div class="font-light pt-1 sm:ml-2 text-xl sm:text-base">{{ $report->earnings->block_hours_flown }} Hours</div>
                </div>
            </li>
            <li class="flex items-center pt-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="h-6 w-6 fill-current text-blue-900">
                    <path d="M320 93.68V178.3L397.1 222.4C350.6 254 320 307.4 320 368C320 422.2 344.5 470.7 383.1 502.1C381 508.3 375.9 512 369.1 512C368.7 512 367.4 511.8 366.1 511.5L256 480L145.9 511.5C144.6 511.8 143.3 512 142 512C134.3 512 128 505.7 128 497.1V456C128 450.1 130.4 446.2 134.4 443.2L192 400V329.1L20.4 378.2C10.17 381.1 0 373.4 0 362.8V297.3C0 291.5 3.076 286.2 8.062 283.4L192 178.3V93.68C192 59.53 221 0 256 0C292 0 320 59.53 320 93.68H320zM640 368C640 447.5 575.5 512 496 512C416.5 512 352 447.5 352 368C352 288.5 416.5 224 496 224C575.5 224 640 288.5 640 368zM540.7 324.7L480 385.4L451.3 356.7C445.1 350.4 434.9 350.4 428.7 356.7C422.4 362.9 422.4 373.1 428.7 379.3L468.7 419.3C474.9 425.6 485.1 425.6 491.3 419.3L563.3 347.3C569.6 341.1 569.6 330.9 563.3 324.7C557.1 318.4 546.9 318.4 540.7 324.7H540.7z" />
                </svg>
                <div class="flex flex-col sm:flex-row sm:items-center ml-4 font-poppins">
                    <div class="font-normal pt-1 text-slate-800">Commute:</div>
                    <div class="font-light pt-1 sm:ml-2 text-xl sm:text-base">{{ $report->earnings->is_commuter ? 'YES' : 'NO' }}</div>
                </div>
            </li>
            <li class="pt-3">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-6 w-6 fill-current text-blue-900"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z" />
                    </svg>
                    <div class="flex flex-col sm:flex-row sm:items-center ml-4 font-poppins">
                        <div class="font-normal pt-1">{{ $report->user->name }} Comments:</div>
                    </div>
                </div>
                <div class="font-light pt-3 sm:ml-2 sm:text-base italic text-sm">{!! $report->earnings->report_comment !!}</div>
            </li>
        </ul>

        @if(Route::currentRouteName() === 'reports.index')
            <!-- BUTTON TO SHOW REPORT -->
            <a href="{{ $report->path() }}" class="black-button mt-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current text-white w-5 h-5 me-2 -ms-1"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z" />
                </svg>
                {{ $report->comments->count() }} COMMENTS
            </a>
        @endif
    </div>
</div>