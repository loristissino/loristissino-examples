<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Form1
    Inherits System.Windows.Forms.Form

    'Form esegue l'override del metodo Dispose per pulire l'elenco dei componenti.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Richiesto da Progettazione Windows Form
    Private components As System.ComponentModel.IContainer

    'NOTA: la procedura che segue è richiesta da Progettazione Windows Form
    'Può essere modificata in Progettazione Windows Form.  
    'Non modificarla nell'editor del codice.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.cmdCreate = New System.Windows.Forms.Button()
        Me.cmdMove = New System.Windows.Forms.Button()
        Me.SuspendLayout()
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Location = New System.Drawing.Point(27, 18)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(387, 13)
        Me.Label1.TabIndex = 0
        Me.Label1.Text = "This application is aimed to show how to generate and manage controls run-time."
        '
        'cmdCreate
        '
        Me.cmdCreate.Location = New System.Drawing.Point(483, 10)
        Me.cmdCreate.Name = "cmdCreate"
        Me.cmdCreate.Size = New System.Drawing.Size(116, 28)
        Me.cmdCreate.TabIndex = 1
        Me.cmdCreate.Text = "Create buttons"
        Me.cmdCreate.UseVisualStyleBackColor = True
        '
        'cmdMove
        '
        Me.cmdMove.Location = New System.Drawing.Point(483, 48)
        Me.cmdMove.Name = "cmdMove"
        Me.cmdMove.Size = New System.Drawing.Size(115, 27)
        Me.cmdMove.TabIndex = 2
        Me.cmdMove.Text = "Move buttons"
        Me.cmdMove.UseVisualStyleBackColor = True
        Me.cmdMove.Visible = False
        '
        'Form1
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(686, 461)
        Me.Controls.Add(Me.cmdMove)
        Me.Controls.Add(Me.cmdCreate)
        Me.Controls.Add(Me.Label1)
        Me.Name = "Form1"
        Me.Text = "ManyButtons"
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents Label1 As System.Windows.Forms.Label
    Friend WithEvents cmdCreate As System.Windows.Forms.Button
    Friend WithEvents cmdMove As System.Windows.Forms.Button

End Class
