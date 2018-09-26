Properties
    id
    state
    features
    runtime
    files
    settings
    total
Methods
    init()
    setOption(option, [value])
    getOption([option])
    refresh()
    start()
    stop()
    disableBrowse(disable)
    getFile(id)
    addFile(file, [fileName])
    removeFile(file)
    splice(start, length)
    trigger(name, Multiple)
    hasEventListener(name)
    bind(name, func, scope)
    unbind(name, func)
    unbindAll()
    destory()
Options
    Required
        browse_button
        url
    filters:
        mime_types
        max_file_size
        prevent_duplicates
    Control the request
        headers
        multipart
        multipart_params
        max_retries
    Chunk
        chunk_size
    Client-side image resize
        resize
        resize.width
        resize.height
        resize.crop
        resize.quality
        resize.preserve_headers
    Drag & Drop
        drop_element
    Other
        multi_selection
        required_feature(for availabe feature, see Features)
        unique_names
        runtimes
        file_data_name
        container
        flash_swf_url
        silverlight_xap_url
Events | auguments
    Init                | uploader
    PostInit            | uploader
    OptionChanged       | uploader, name, value, oldValue
    Refresh             | uploader
    StateChanged        | uploader
    UploadFile          | uploader, file
    BeforeUpload        | uploader, file
    QueueChanged        | uploader
    UploadProgress      | uploader, file
    FilesRemoved        | uploader, files
    FileFiltered        | uploader, file
    FilesAdded          | uploader, files
    FileUploaded        | uploader, file, response
    ChunkUploaded       | uploader, file, response
    UploadComplete      | uploader, files
    Error               | uploader, error
    Destory             | uploader
Features
    access_binary 
    access_image_binary 
    display_media 
    do_cors 
    drag_and_drop 
    filter_by_extension 
    resize_image 
    report_upload_progress 
    return_response_headers 
    return_response_type 
    return_status_code 
    send_custom_headers 
    select_file 
    select_folder 
    select_multiple 
    send_binary_string 
    send_browser_cookies 
    send_multipart 
    slice_blob 
    stream_upload 
    summon_file_dialog 
    upload_filesize 
    use_http_method 
