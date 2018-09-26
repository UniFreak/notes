==================== Shortcut ====================
F5
F8
Ctrl + Break
Ctrl + R
Ctrl + T
Ctrl + +/-

==================== Syntax ====================
Comments:
    # Single line comment

    <#
        Multiple line
        comments
    #>

    #region title is optional
    #code here
    #endregion title is optional
Cmdlet: basic unit of command
    all have the <verb>-<none> format
    examples:
        Get-command
        Get-command -verb "get"            # -verb is a parameter(has value)
        Get-command -none "service"
        Get-help Get-command -examples     # -examples is a switch(hasn't value)
        Get-help Get-command -detailed
Alias: shortcut to Cmdlet
    Get-Alias <alias>
    Get-Alias dir
    Get-Alias -Definition Get-ChildItem

    BestPractice: don't use alias if you are writting script for others to use
Pipeline(can combine with `(see below))
    Get-ChildItem |
        Where-Object { $_.Length -gt 10kb} |
        Sort-Length Length |
        Format-Table -Property Name, Length -AutoSize

    Get-ChildItem | Select-Object Name, Length
Line continuation: `  (seperate long command into multiple line)
    Get-ChildItem -Path C:\PS `
                  -File "*.ps1" `
                  -Verbose
